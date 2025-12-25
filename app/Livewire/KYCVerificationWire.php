<?php

namespace App\Livewire;

use App\Enums\DateTypeEnum;
use App\Enums\DistrictEnum;
use App\Enums\KYCEnum;
use App\Enums\KYCStatusEnum;
use App\Mail\TestMail;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

class KYCVerificationWire extends Component
{
    use WithFileUploads;

    public $first_name;

    #[Locked]
    public $kyc_status;

    public $middle_name;

    public $last_name;

    public $dob = [
        'year' => null,
        'month' => null,
        'day' => null
    ];

    public $dob_date_type;

    public $gender;

    public $father_or_husband_name;

    public $grandfather_or_father_in_law_name;

    public $marital_status;

    public $permanent_address = [
        'address' => null,
        'district' => null,
        'municipality' => null,
        'ward_no' => null
    ];

    public $temporary_address = [
        'address' => null,
        'district' => null,
        'municipality' => null,
        'ward_no' => null
    ];


    public $citizenship_number;

    public $issued_district;

    public $date_of_issued = [
        'year' => null,
        'month' => null,
        'day' => null
    ];

    public $districts;

    public $document_front;

    public $document_back;

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'dob.*' => 'required',
            'date_of_issued.*' => 'required',
            'dob_date_type' => 'required',
            'gender' => 'required|in:male,female,other',
            'father_or_husband_name' => 'required|string|max:150',
            'grandfather_or_father_in_law_name' => 'required|string|max:150',
            'marital_status' => 'required|in:single,married,divorced,widowed',
            'permanent_address.address' => 'required|string',
            'permanent_address.district' => 'required|string',
            'permanent_address.municipality' => 'required|string',
            'permanent_address.ward_no' => 'required|string',
            'temporary_address.address' => 'required|string',
            'temporary_address.district' => 'required|string',
            'temporary_address.municipality' => 'required|string',
            'temporary_address.ward_no' => 'required|string',
            'citizenship_number' => 'required|string|max:50|regex:/^[A-Za-z0-9\-]+$/',
            'issued_district' => 'required',
            'document_front' => 'required|mimes:jpeg,png,jpg,webp|max:2048',
            'document_back' => 'required|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Please enter your first name.',
            'first_name.string' => 'The first name must be a valid string.',
            'last_name.required' => 'Please enter your last name.',
            'dob.year.required' => 'Year of birth is required.',
            'dob.month.required' => 'Month of birth is required.',
            'dob.day.required' => 'Day of birth is required.',
            'date_of_issued.year.required' => 'Year of issue is required.',
            'date_of_issued.month.required' => 'Month of issue is required.',
            'date_of_issued.day.required' => 'Day of issue is required.',
            'gender.required' => 'Please select your gender.',
            'gender.in' => 'Please choose a valid gender option.',
            'father_or_husband_name.required' => 'Please provide your father’s or husband’s name.',
            'marital_status.required' => 'Please select your marital status.',
            'marital_status.in' => 'Invalid marital status selected.',
            'permanent_address.address.required' => 'Permanent address is required.',
            'permanent_address.district.required' => 'Permanent district is required.',
            'permanent_address.municipality.required' => 'Permanent municipality is required.',
            'permanent_address.ward_no.required' => 'Permanent ward no. is required.',
            'temporary_address.address.required' => 'Temporary address is required.',
            'temporary_address.district.required' => 'Temporary district is required.',
            'temporary_address.municipality.required' => 'Temporary municipality is required.',
            'temporary_address.ward_no.required' => 'Temporary ward no. is required.',
            'citizenship_number.required' => 'Please enter your citizenship number.',
            'citizenship_number.regex' => 'The citizenship number format is invalid.',
            'issued_district.required' => 'Please select the district where your citizenship was issued.',
        ];
    }


    public function mount()
    {
        $this->kyc_status = auth()->user()->kyc?->status;
        $this->districts = DistrictEnum::cases();
        $this->dob_date_type = DateTypeEnum::BS->value;
    }

    public function render()
    {
        return view('livewire.k-y-c-verification-wire');
    }

    public function submit()
    {
        $validated_data = $this->validate();
        $validated_data['document_front'] = $this->document_front->store('kyc_images');
        $validated_data['document_back'] = $this->document_back->store('kyc_images');
        $user = auth()->user();
        $kyc = $user->kyc;
        if ($kyc) {
            $kyc->details = $validated_data;
            $kyc->status = KYCStatusEnum::Pending;
            $kyc->save();
        } else {
            $user->kyc()->create([
                'type' => KYCEnum::Personal,
                'details' => $validated_data
            ]);
        }
        $this->kyc_status = KYCStatusEnum::Pending;
    }
}
