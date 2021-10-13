<?php declare(strict_types=1);

namespace HJerichen\Collections\Test\Helpers;

class GetIdObject
{
    private ?int $id;

    public function __construct(?int $id) {
        $this->id = $id;
    }

    /**
     * @noinspection PhpUnused
     * @noinspection UnknownInspectionInspection
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
