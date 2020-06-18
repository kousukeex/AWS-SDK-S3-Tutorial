<?php
        require_once 'vendor/autoload.php';

        use Aws\S3\S3Client;

        $s3client = new S3Client([
        'version' => 'latest',
        'region' => 'us-east-1',
        'credentials' => false
]);

        try{
                $result = $s3client->getObject([
                        'Bucket' => 'iudwffhfhdkkfauufehvjcxvxksk',
                        'Key'    => 'test.c'
                ]);
                $result2 = $s3client->putObject([
                        'Bucket' => 'iudwffhfhdkkfauufehvjcxvxksk',
                        'Key'    => 'test.java',
                        'Body'   => 'Hello!'
                ]);
                echo $result;
                echo $result2;
        }catch(Exception $e){
                echo "failed to upload:" . PHP_EOL , $e->getMessage() . PHP_EOL;
        }
?>
