<?php
        //Composerから、モジュールを読み込む
        require_once 'vendor/autoload.php';

        //長いので、省略できるように定義している
        use Aws\S3\S3Client;

        //ここで、AWSのS3の利用するクライアント情報を定義している
        //version,　latestでいいと思う
        //region,　 S3とEC2で稼働している地域を定義する必要がある、今回はus-east-1でOK
        //credentials、　資格情報を読み取るかどうか、Trueで読み取るがFalseでは読まない
        //              Falseにしないと、アクセスできないので注意
        //              また、S3のアクセス先のパケットポリシーも設定しないと接続ができない
        $s3client = new S3Client([
        'version' => 'latest',
        'region' => 'us-east-1',
        'credentials' => false
        ]);

        try{
                //簡単な実行
                //取得メソッド
                //HTTPメソッドのGETメソッドで実行し、HTTPResponseを取得する
                //詳しいことは省くが$result["Body"]でデータを取得することができる
                //但し、データは文字列(もしくはバイナリ型)なので、そのまま出力すると思い通りにいかないので注意
                
                //引数は連想配列だが、面倒なら省略できるが順番に注意
                //読みやすさを重視するなら連想配列で良い
                
                //引数(ここでは連想配列方式で行うため"キー:値名"で行う)
                //Bucket : S3のアクセス先(バケットと呼ぶ)
                //Key    : アクセス先にあるファイルの指定
                $result = $s3client->getObject([
                        'Bucket' => 'iudwffhfhdkkfauufehvjcxvxksk',
                        'Key'    => 'test.c'
                ]);
                
                //送信メソッド
                //HTTPメソッドのPUTメソッドで実行し、HTTPRequestを送信する
                //postObjectなんてのがあるけど、重要なデータではないならputObjectでいい
                //送信するデータはBodyで、定義する必要があるので、注意
                //定義しないと、空のファイルを送り付けて上書きしてくる
                //Bodyの定義は読み込んだデータを引数に入れることで、多分できるはず
                
                //引数
                //Bucket : S3のアクセス先(バケットと呼ぶ)
                //Key    : 送信するファイル名
                //Body   : HTTPRequestのBodyパケット、要するに送信ファイルの中身
                $result2 = $s3client->putObject([
                        'Bucket' => 'iudwffhfhdkkfauufehvjcxvxksk',
                        'Key'    => 'test.java',
                        'Body'   => 'Hello!'
                ]);
                //結果を出力する、ちなみに連想配列で出力される
                //JSONでできるなら、変換して出力すると良いかも
                echo $result;
                echo $result2;
        }catch(Exception $e){
                //アクセスが拒否された、指定がうまくいってないときに例外が出力される
                //ステータスコードが400系ならクライアントの問題
                //                500系ならS3側の問題?
                echo "failed to upload:" . PHP_EOL , $e->getMessage() . PHP_EOL;
        }
?>
