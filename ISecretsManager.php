<?php
require 'vendor\autoload.php';

use Aws\Ssm\SsmClient;
use Aws\Credentials\CredentialProvider;
use Aws\S3\S3Client;
use Aws\Iam\IamClient; 
use Aws\Exception\AwsException;

interface ISecretsManager {
    public function Get($key);
}



class AWSParameterStore implements ISecretsManager {
    public function Get($key) {
        try {
            $path = "%USERPROFILE%\.aws\credentials";
            $provider = CredentialProvider::ini('default', $path); 
            $provider = CredentialProvider::memoize($provider);


            //Create a SSMClient
            $client = new SsmClient([
                'version' => 'latest',
                'region' => 'us-west-2',
                'credentials' => $provider,
            ]);



            // echo "\r\nmade it here";
            $result = $client->getParameter([
                "Name" => $key,
                "WithDecrpytion" => true
            ]);
            $_ENV[$key] = $result["Parameter"]["Value"];
            return $result["Parameter"]["Value"];
        }
        catch (AwsException $e) {
            echo ("\r\nError: " . $e->__toString());

            echo ("Error: " . $e->getAwsErrorMessage());
        }
    }
}

            // IAM ***************************************************************
            // $client = new IamClient([
            //     'region' => 'us-west-2',
            //     'version' => 'latest',
            //     'credentials' => [
            //         'key' => 'key',
            //         'secret' => 'secret',
            //     ]
            // ]);
            
            // try {
            //     $result = $client->listServerCertificates();
            //     echo $result->__toString();
            //     var_dump($result);
            // } catch (AwsException $e) {
            //     // output error message if fails
            //     echo $e->__toString();
            //     error_log($e->getMessage());
            // }
             

            // S3 ************************************************************
            // $s3Client = new S3Client([
            //     'version' => 'latest',
            //     'region' => 'us-west-2',
            //     'scheme' => 'http',
            //     'credentials' => [
            //         'key' => 'key',
            //         'secret' => 'secret',
            //     ]
            // ]);

            // try {
            //     $result = $s3Client->createBucket([
            //         'Bucket' => 'fuelingphpbucket',
            //     ]);
            //     echo('The bucket\'s location is: ' .
            //     $result['Location'] . '. ' .
            //     'The bucket\'s effective URI is: ' .
            //     $result['@metadata']['effectiveUri']);
            //     print_r('The bucket\'s location is: ' .
            //         $result['Location'] . '. ' .
            //         'The bucket\'s effective URI is: ' .
            //         $result['@metadata']['effectiveUri']);
            // } catch (AwsException $e) {
            //     print_r('Error: ' . $e->getAwsErrorMessage());
            //     echo ("\r\nError: " . $e->__toString());
            //     echo('Error: ' . $e->getAwsErrorMessage());
            // }