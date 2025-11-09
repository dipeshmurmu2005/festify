<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum DistrictEnum: string implements HasLabel
{
    case Achham = 'Achham';
    case Arghakhanchi = 'Arghakhanchi';
    case Baglung = 'Baglung';
    case Baitadi = 'Baitadi';
    case Bajhang = 'Bajhang';
    case Bajura = 'Bajura';
    case Banke = 'Banke';
    case Bara = 'Bara';
    case Bardiya = 'Bardiya';
    case Bhaktapur = 'Bhaktapur';
    case Bhojpur = 'Bhojpur';
    case Chitwan = 'Chitwan';
    case Dadeldhura = 'Dadeldhura';
    case Dailekh = 'Dailekh';
    case Dang = 'Dang';
    case Darchula = 'Darchula';
    case Dhading = 'Dhading';
    case Dhankuta = 'Dhankuta';
    case Dhanusha = 'Dhanusha';
    case Dolakha = 'Dolakha';
    case Dolpa = 'Dolpa';
    case Doti = 'Doti';
    case EasternRukum = 'Eastern Rukum';
    case Gorkha = 'Gorkha';
    case Gulmi = 'Gulmi';
    case Humla = 'Humla';
    case Ilam = 'Ilam';
    case Jajarkot = 'Jajarkot';
    case Jhapa = 'Jhapa';
    case Jumla = 'Jumla';
    case Kailali = 'Kailali';
    case Kalikot = 'Kalikot';
    case Kanchanpur = 'Kanchanpur';
    case Kapilvastu = 'Kapilvastu';
    case Kaski = 'Kaski';
    case Kathmandu = 'Kathmandu';
    case Kavrepalanchok = 'Kavrepalanchok';
    case Khotang = 'Khotang';
    case Lalitpur = 'Lalitpur';
    case Lamjung = 'Lamjung';
    case Mahottari = 'Mahottari';
    case Makwanpur = 'Makwanpur';
    case Manang = 'Manang';
    case Morang = 'Morang';
    case Mugu = 'Mugu';
    case Mustang = 'Mustang';
    case Myagdi = 'Myagdi';
    case Nawalpur = 'Nawalpur';
    case Nuwakot = 'Nuwakot';
    case Okhaldhunga = 'Okhaldhunga';
    case Palpa = 'Palpa';
    case Panchthar = 'Panchthar';
    case Parbat = 'Parbat';
    case Parasi = 'Parasi';
    case Parsa = 'Parsa';
    case Pyuthan = 'Pyuthan';
    case Ramechhap = 'Ramechhap';
    case Rasuwa = 'Rasuwa';
    case Rautahat = 'Rautahat';
    case Rolpa = 'Rolpa';
    case RukumWest = 'Rukum West';
    case Rupandehi = 'Rupandehi';
    case Salyan = 'Salyan';
    case Sankhuwasabha = 'Sankhuwasabha';
    case Saptari = 'Saptari';
    case Sarlahi = 'Sarlahi';
    case Sindhuli = 'Sindhuli';
    case Sindhupalchok = 'Sindhupalchok';
    case Siraha = 'Siraha';
    case Solukhumbu = 'Solukhumbu';
    case Sunsari = 'Sunsari';
    case Surkhet = 'Surkhet';
    case Syangja = 'Syangja';
    case Tanahun = 'Tanahun';
    case Taplejung = 'Taplejung';
    case Terhathum = 'Terhathum';
    case Udayapur = 'Udayapur';

    public function getLabel(): ?string
    {
        return $this->value;
    }
}
