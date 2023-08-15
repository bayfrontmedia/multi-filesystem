## Multi-Filesystem

An easy-to-use library used to manage multiple [Flysystem](https://flysystem.thephpleague.com/) adapters from a single class.

- [License](#license)
- [Author](#author)
- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)

## License

This project is open source and available under the [MIT License](LICENSE).

## Author

<img src="https://cdn1.onbayfront.com/bfm/brand/bfm-logo.svg" alt="Bayfront Media" width="250" />

- [Bayfront Media homepage](https://www.bayfrontmedia.com?utm_source=github&amp;utm_medium=direct)
- [Bayfront Media GitHub](https://github.com/bayfrontmedia)

## Requirements

* PHP `^8.0`

## Installation

```
composer require bayfrontmedia/multi-filesystem
```

## Usage

**NOTE:** All exceptions thrown by Multi-Filesystem extend `Bayfront\MultiFilesytstem\Exceptions\MultiFilesystemException`, so you can choose to catch exceptions as narrowly or broadly as you like.

A disk name and a `League\Flysystem\Filesystem` instance must be passed to the constructor, and will automatically be set as the default disk.

To aid in consistency when referencing disks, the `Bayfront\MultiFilesystem\DiskName` class contains constants for each of the supported Flysystem adapters.

**Example:**

```php
use Bayfront\MultiFilesystem\Disk;
use Bayfront\MultiFilesystem\DiskName;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\Filesystem;

$local_adapter = new LocalFilesystemAdapter(__DIR__.'/root/directory/');
$local = new Filesystem($local_adapter);

$disk = new Disk(DiskName::LOCAL, $local);
```

### Public methods

- [getNames](#getnames)
- [getDefaultName](#getdefaultname)
- [add](#add)
- [exists](#exists)
- [get](#get)

<hr />

### getNames

**Description:**

Return array of disk names.

**Parameters:**

- (None)

**Returns:**

- (array)

<hr />

### getDefaultName

**Description:**

Return name of default disk.

**Parameters:**

- (None)

**Returns:**

- (string)

<hr />

### add

**Description:**

Add a `League\Flysystem\Filesystem` instance as a new disk.

If a disk exists with the same name, it will be overwritten.

**Parameters:**

- `$name` (string): Name of disk
- `$filesystem` (object): `League\Flysystem\Filesystem` object

**Returns:**

- (self)

**Example:**

```php
use Aws\S3\S3Client;
use Bayfront\MultiFilesystem\DiskName;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;
use League\Flysystem\Filesystem;

$s3_client = new S3Client([ // Example connecting to Linode object storage
    'version' => 'latest',
    'region' => 'us-southeast-1',
    'endpoint' => 'https://us-southeast-1.linodeobjects.com',
    'credentials' =>
        [
            'key' => 'LINODE_ACCESS_KEY',
            'secret' => 'LINODE_SECRET_KEY',
        ],
]);

$bucket_name = 'NAME_OF_BUCKET';
$path_prefix = 'path/to/storage'; // No leading slash

$s3_adapter = new AwsS3V3Adapter($s3_client, $bucket_name, $path_prefix);
$s3 = new Filesystem($s3_adapter);

$disk->add(DiskName::AWS_S3, $s3);
```

<hr />

### exists

**Description:**

Does disk name exist?

**Parameters:**

- `$disk` (string)

**Returns:**

- (bool)

**Example:**

```
if ($disk->exists('local')) {
    // Do something
}
```

<hr />

### get

**Description:**

Returns `League\Flysystem\Filesystem` instance for a given disk.

**Parameters:**

- `$disk = ''` (string): Name of disk to return. If empty string, the default disk will be returned.

**Returns:**

- (object): `League\Flysystem\Filesystem` object

**Throws:**

- `Bayfront\MultiFilesystem\Exceptions\DiskNotFoundException`

**Example:**

```
try {

    $local_disk = $disk->get('local');

} catch (DiskNotFoundException $e) {
    die($e->getMessage());
}
```