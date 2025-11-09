   <div class="space-y-3 divide-y divide-gray-200">
       <div class="pb-2">
           <h2 class="font-semibold text-base flex items-center gap-5 mb-2">KYC Verification
               <div class="inline-flex text-white items-center gap-1 font-medium text-xs px-3 py-1 rounded-sm"
                   style="background-color:var(--color-{{ $this->kyc_status->getColor() }})">
                   <x-icon name="{{ $this->kyc_status->getIcon() }}" class="h-4 w-4" />
                   {{ $this->kyc_status->getLabel() }}
               </div>
           </h2>
           @if ($this->kyc_status == null)
               <p class="text-gray-700">Complete your identity verification to unlock full access and keep your
                   account secure.</p>
           @elseif($this->kyc_status->value == 'pending')
               <p class="text-gray-700">Your verification is under review. Please wait for approval.</p>
           @elseif($this->kyc_status->value == 'failed')
               <p class="text-gray-700">Your verification is under review. Please wait for approval.</p>
           @else
               <p class="text-gray-700">Your identity is confirmed and your account is fully unlocked.</p>
           @endif

       </div>
       <div>
           @if ($this->kyc_status == null || $this->kyc_status->value == 'failed')
               <form wire:submit.prevent="submit()" class="mt-5 space-y-5" x-data="kyc">
                   <div>
                       <h2 class="font-semibold text-gray-700">Personal Information</h2>
                       <div class="grid grid-cols-5 gap-5">
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">First Name<span class="text-error">*</span></legend>
                               <input type="text" class="input" placeholder="Ram" wire:model="first_name" />
                               @error('first_name')
                                   <p class="label text-error">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Middle Name <span class="text-gray-500">(optional)</span>
                               </legend>
                               <input type="text" class="input" placeholder="Bahadur" wire:model="middle_name" />
                               @error('middle_name')
                                   <p class="label text-error">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Last Name<span class="text-error">*</span></legend>
                               <input type="text" class="input" placeholder="Gurung" wire:model="last_name" />
                               @error('last_name')
                                   <p class="label text-error">{{ $message }}</p>
                               @enderror
                           </fieldset>
                       </div>
                       <div class="mt-2 grid grid-cols-5 gap-5">
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Date of Birth<span class="text-error">*</span></legend>
                               <div class="flex gap-2">
                                   <select class="select w-16" wire:model="dob_date_type">
                                       <option value="BS">BS</option>
                                       <option value="AD">AD</option>
                                   </select>
                                   <input type="text" wire:model="dob.year" x-mask="9999" placeholder="YYYY"
                                       class="input w-16" />
                                   <input type="text" wire:model="dob.month" x-mask="99" placeholder="MM"
                                       class="input w-16" />
                                   <input type="text" wire:model="dob.day" x-mask="99" placeholder="DD"
                                       class="input w-16" />
                               </div>
                               @error('dob.*')
                                   <p class="label text-error">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset" x-data="{
                               gender: null,
                           }">
                               <legend class="fieldset-legend">Gender<span class="text-error">*</span></legend>
                               <input id="male" type="radio" name="gender" value="male" wire:model="gender"
                                   x-model="gender" hidden>
                               <input id="female" type="radio" name="gender" value="female" wire:model="gender"
                                   x-model="gender" hidden>
                               <input id="other" type="radio" name="gender" value="other" wire:model="gender"
                                   x-model="gender" hidden>
                               <div>
                                   <label for="male" :class="gender == 'male' ? 'btn-primary' : ''"
                                       class="btn"><x-hugeicons-male-symbol class="h-5 w-5" />
                                       Male</label>
                                   <label for="female" class="btn"
                                       :class="gender == 'female' ? 'btn-primary' : ''"><x-hugeicons-female-symbol
                                           class="h-5 w-5" />
                                       Female</label>
                                   <label for="other" :class="gender == 'other' ? 'btn-primary' : ''"
                                       class="btn">Other</label>
                               </div>
                               @error('gender')
                                   <p class="label text-error">{{ $message }}</p>
                               @enderror
                           </fieldset>
                       </div>
                   </div>
                   <div>
                       <h2 class="font-semibold text-gray-700">Family Information</h2>
                       <div class="grid grid-cols-5 gap-5">
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Father's / Husband's Name<span
                                       class="text-error">*</span>
                               </legend>
                               <input type="text" class="input" placeholder="Ramesh Gurung"
                                   wire:model="father_or_husband_name" />
                               @error('father_or_husband_name')
                                   <p class="label text-error">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Grandfather's / Father in Law's Name<span
                                       class="text-error">*</span></legend>
                               <input type="text" class="input" placeholder="Ravinath Gurung"
                                   wire:model="grandfather_or_father_in_law_name" />
                               @error('grandfather_or_father_in_law_name')
                                   <p class="label text-error text-wrap">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Marital Status<span class="text-error">*</span>
                               </legend>
                               <div>
                                   <label for="single" class="btn justify-start">
                                       <input type="radio" id="single" name="radio-1"
                                           class="radio radio-xs radio-primary" value="single"
                                           wire:model="marital_status" />
                                       <span class="text-xs font-medium">Single</span>
                                   </label>
                                   <label for="married" class="btn justify-start">
                                       <input type="radio" id="married" name="radio-1"
                                           class="radio radio-xs radio-primary" value="married"
                                           wire:model="marital_status" />
                                       <span class="text-xs font-medium">Married</span>
                                   </label>
                               </div>
                               @error('marital_status')
                                   <p class="label text-error text-wrap">{{ $message }}</p>
                               @enderror
                           </fieldset>
                       </div>
                   </div>
                   <div>
                       <h2 class="font-semibold text-gray-700">Permanent Address Details</h2>
                       <div class="grid grid-cols-5 gap-5">
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Permanent Address<span class="text-error">*</span>
                               </legend>
                               <input type="text" wire:model="permanent_address.address" class="input"
                                   placeholder="Birtamode Jhapa" />
                               @error('permanent_address.address')
                                   <p class="label text-error text-wrap">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">District<span class="text-error">*</span></legend>
                               <select class="select" x-model="p_district" wire:model="permanent_address.district">
                                   <option value="">Select District</option>
                                   @foreach ($this->districts as $district)
                                       <option value="{{ $district->value }}">{{ $district->getLabel() }}</option>
                                   @endforeach
                               </select>
                               @error('permanent_address.district')
                                   <p class="label text-error text-wrap">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Municipality<span class="text-error">*</span></legend>
                               <select class="select" wire:model="permanent_address.municipality">
                                   <option value="">Select Municipality</option>
                                   <template x-for="(municipality,index) in p_municipalities">
                                       <option :value="municipality" x-text="municipality"></option>
                                   </template>
                               </select>
                               @error('permanent_address.municipality')
                                   <p class="label text-error text-wrap">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Ward No<span class="text-error">*</span></legend>
                               <input type="text" class="input w-32" wire:model="permanent_address.ward_no"
                                   placeholder="2" />
                               @error('permanent_address.ward_no')
                                   <p class="label text-error text-wrap">{{ $message }}</p>
                               @enderror
                           </fieldset>
                       </div>
                   </div>
                   <div>
                       <h2 class="font-semibold text-gray-700">Temporary Address Details</h2>
                       <div class="grid grid-cols-5 gap-5">
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Temporary Address<span class="text-error">*</span>
                               </legend>
                               <input type="text" wire:model="temporary_address.address" class="input"
                                   placeholder="Birtamode Jhapa" />
                               @error('temporary_address.address')
                                   <p class="label text-error text-wrap">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">District<span class="text-error">*</span></legend>
                               <select class="select" x-model="t_district" wire:model="temporary_address.district">
                                   <option value="">Select District</option>
                                   @foreach ($this->districts as $district)
                                       <option value="{{ $district->value }}">{{ $district->getLabel() }}</option>
                                   @endforeach
                               </select>
                               @error('temporary_address.district')
                                   <p class="label text-error text-wrap">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Municipality<span class="text-error">*</span></legend>
                               <select class="select" wire:model="temporary_address.municipality">
                                   <option value="">Select Municipality</option>
                                   <template x-for="(municipality,index) in t_municipalities">
                                       <option :value="municipality" x-text="municipality"></option>
                                   </template>
                               </select>
                               @error('temporary_address.municipality')
                                   <p class="label text-error text-wrap">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Ward No<span class="text-error">*</span></legend>
                               <input type="text" class="input w-32" wire:model="temporary_address.ward_no"
                                   placeholder="2" />
                               @error('temporary_address.ward_no')
                                   <p class="label text-error text-wrap">{{ $message }}</p>
                               @enderror
                           </fieldset>
                       </div>
                   </div>
                   <div>
                       <h2 class="font-semibold text-gray-700">Identification Documents</h2>
                       <div class="grid grid-cols-5 gap-5">
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Citzenship Number<span class="text-error">*</span>
                               </legend>
                               <input type="text" class="input" wire:model="citizenship_number"
                                   placeholder="#####-###-####" />
                               @error('citizenship_number')
                                   <p class="label text-error text-wrap">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Issued District<span class="text-error">*</span>
                               </legend>
                               <select class="select" wire:model="issued_district">
                                   <option value="">Select District</option>
                                   @foreach ($this->districts as $district)
                                       <option value="{{ $district->value }}">{{ $district->getLabel() }}</option>
                                   @endforeach
                               </select>
                               @error('issued_district')
                                   <p class="label text-error text-wrap">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <fieldset class="fieldset">
                               <legend class="fieldset-legend">Date of Issued<span class="text-error">*</span>
                               </legend>
                               <div class="flex gap-2">
                                   <select class="select w-16" wire:model="date_of_issued_date_type">
                                       <option value="BS">BS</option>
                                       <option value="AD">AD</option>
                                   </select>
                                   <input type="text" wire:model="date_of_issued.year" x-mask="9999"
                                       placeholder="YYYY" class="input w-16" />
                                   <input type="text" wire:model="date_of_issued.month" x-mask="99"
                                       placeholder="MM" class="input w-16" />
                                   <input type="text" wire:model="date_of_issued.day" x-mask="99"
                                       placeholder="DD" class="input w-16" />
                               </div>
                               @error('date_of_issued.*')
                                   <p class="label text-error">{{ $message }}</p>
                               @enderror
                           </fieldset>
                           <div class="col-span-5 grid grid-cols-3 gap-5">
                               <input type="file" id="document_front" name="" id=""
                                   wire:model="document_front" hidden>
                               <div>
                                   <label for="document_front"
                                       class="h-[300px] overflow-hidden group border relative  cursor-pointer group border-gray-300 rounded-xl text-gray-6 flex flex-col gap-2 justify-center items-center">
                                       <div class="h-full w-full">
                                           <div class="h-[85%] w-full opacity-50">
                                               <img src="https://icons.veryicon.com/png/o/miscellaneous/former-building-people/front-of-id-card.png"
                                                   alt="" class="h-full w-full object-contain">
                                           </div>
                                           <h2 class="text-center font-semibold text-gray-600">Citizenship Front</h2>
                                       </div>
                                       @if ($this->document_front)
                                           <div class="absolute left-0 top-0 h-full w-full">
                                               <div class="relative h-full w-full">
                                                   <img src="{{ $this->document_front->temporaryUrl() }}"
                                                       alt="" class="h-full w-full object-cover">
                                                   <div
                                                       class="absolute text-white hidden group-hover:flex h-full w-full left-0 top-0 bg-black/50 flex-col justify-center items-center">
                                                       <div>
                                                           Click Here to Change Image
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       @endif
                                   </label>
                                   <div class="mt-2">
                                       @error('document_front')
                                           <p class="label text-error">{{ $message }}</p>
                                       @enderror
                                   </div>
                               </div>
                               <input type="file" id="document_back" name="" id=""
                                   wire:model="document_back" hidden>
                               <div>
                                   <label for="document_back"
                                       class="h-[300px] overflow-hidden border group relative  cursor-pointer group border-gray-300 rounded-xl text-gray-6 flex flex-col gap-2 justify-center items-center">
                                       <div class="h-full w-full">
                                           <div class="h-[85%] w-full opacity-50">
                                               <img src="https://icons.veryicon.com/png/o/miscellaneous/former-building-people/back-of-id-card.png"
                                                   alt="" class="h-full w-full object-contain">
                                           </div>
                                           <h2 class="text-center font-semibold text-gray-600">Citizenship Back</h2>
                                       </div>
                                       @if ($this->document_back)
                                           <div class="absolute left-0 top-0 h-full w-full">
                                               <div class="relative h-full w-full">
                                                   <img src="{{ $document_back->temporaryUrl() }}" alt=""
                                                       class="h-full w-full object-cover">
                                               </div>
                                               <div
                                                   class="absolute text-white hidden group-hover:flex h-full w-full left-0 top-0 bg-black/50 flex-col justify-center items-center">
                                                   <div>
                                                       Click Here to Change Image
                                                   </div>
                                               </div>
                                           </div>
                                       @endif
                                   </label>
                                   <div class="mt-2">
                                       @error('document_back')
                                           <p class="label text-error">{{ $message }}</p>
                                       @enderror
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <button class="btn btn-primary">Request For Verification</button>
               </form>
           @endif
       </div>
   </div>
