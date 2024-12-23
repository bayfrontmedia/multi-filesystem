<?php /** @noinspection PhpUnused */

namespace Bayfront\MultiFilesystem;

class DiskName
{

    /*
     * Names of official Flysystem adapters
     */

    public const string LOCAL = 'LOCAL';
    public const string FTP = 'FTP';
    public const string MEMORY = 'MEMORY';
    public const string PATH_PREFIXING = 'PATH_PREFIXING';
    public const string AWS_S3 = 'AWS_S3';
    public const string ASYNC_AWS_S3 = 'ASYNC_AWS_S3';
    public const string AZURE_BLOB_STORAGE = 'AZURE_BLOB_STORAGE';
    public const string GOOGLE_CLOUD_STORAGE = 'GOOGLE_CLOUD_STORAGE';
    public const string SFTP_V2 = 'SFTP_V2';
    public const string SFTP_V3 = 'SFTP_V3';
    public const string WEBDAV = 'WEBDAV';
    public const string ZIP_ARCHIVE = 'ZIP_ARCHIVE';

}