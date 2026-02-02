<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template\Bridge;

use InvalidArgumentException;

final class Donor
{
    /**
     * @var string
     */
    private $identificationNumber;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $taxNumber;

    /**
     * @var string|null
     */
    private $taxAddress;

    /**
     * @var string|null
     */
    private $address;
    
    /**
     * @var string|null
     */
    private $nik;

    private function __construct(string $identificationNumber, string $name, ?string $taxNumber, ?string $address, ?string $taxAddress, ?string $nik = null)
    {
        $this->identificationNumber = $identificationNumber;
        $this->name = $name;
        $this->taxNumber = $taxNumber;
        $this->taxAddress = $taxAddress;
        $this->address = $address;
        $this->nik = $nik;
    }

    public static function fromArray(array $input): self
    {
        if (! array_key_exists('identification_number', $input) || ! array_key_exists('name', $input)) {
            throw new InvalidArgumentException();
        }

        $identificationNumber = $input['identification_number'];
        $name = $input['name'];

        if (! is_string($identificationNumber) || ! is_string($name)) {
            throw new InvalidArgumentException();
        }

        $taxNumber = array_key_exists('tax_number', $input) ? $input['tax_number'] : null;
        $taxAddress = array_key_exists('tax_address', $input) ? $input['tax_address'] : null;
        $address = array_key_exists('address', $input) ? $input['address'] : null;
        $nik = array_key_exists('nik', $input) ? $input['nik'] : null;

        return new self($identificationNumber, $name, $taxNumber, $address, $taxAddress, $nik);
    }

    public function getIdentificationNumber(): string
    {
        return $this->identificationNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    public function getTaxAddress(): ?string
    {
        return $this->taxAddress;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getNik(): ?string
    {
        return $this->nik;
    }
}
