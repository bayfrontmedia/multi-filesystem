<?php

namespace Bayfront\MultiFilesystem;

use Bayfront\MultiFilesystem\Exceptions\DiskNotFoundException;
use League\Flysystem\Filesystem;

class Disk
{

    private string $default_disk;

    /**
     * Disk constructor.
     *
     * @param string $name (Name of disk)
     * @param Filesystem $filesystem (Automatically set as the default disk)
     */
    public function __construct(string $name, Filesystem $filesystem)
    {
        $this->add($name, $filesystem);
        $this->default_disk = $name;
    }

    private array $disks = []; // Filesystem instances

    /**
     * Return array of disk names.
     *
     * @return array
     */

    public function getNames(): array
    {
        return array_keys($this->disks);
    }

    /**
     * Return name of default disk.
     *
     * @return string
     */

    public function getDefaultName(): string
    {
        return $this->default_disk;
    }

    /**
     * Add a League\Flysystem\Filesystem instance as a new disk
     *
     * If a disk exists with the same name, it will be overwritten.
     *
     * @param string $name (Name of disk)
     * @param Filesystem $filesystem
     * @return self
     */

    public function add(string $name, Filesystem $filesystem): self
    {
        $this->disks[$name] = $filesystem;
        return $this;
    }

    /**
     * Does disk name exist?
     *
     * @param string $disk
     * @return bool
     */

    public function exists(string $disk): bool
    {
        return in_array($disk, $this->getNames());
    }

    /**
     * Returns League\Flysystem\Filesystem instance for a given disk.
     *
     * @param string $disk (Name of disk to return. If empty string, the default disk will be returned.)
     * @return Filesystem
     * @throws DiskNotFoundException
     */

    public function get(string $disk = ''): Filesystem
    {

        if ($disk == '') {
            $disk = $this->getDefaultName();
        }

        if (!$this->exists($disk)) {
            throw new DiskNotFoundException('Unable to get disk (' . $disk . '): disk not found');
        }

        return $this->disks[$disk];

    }

}