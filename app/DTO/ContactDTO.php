<?php
namespace App\DTO;

class ContactDTO
{
    public $name;
    public $cpf;
    public $phone;
    public $address;
    public $latitude;
    public $longitude;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->cpf = $data['cpf'];
        $this->phone = $data['phone'];
        $this->address = $data['address'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
    }
}
