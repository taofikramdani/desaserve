<?php

return [
    's3_bucket' => getenv('AWS_S3_BUCKET') ?: '',
    'region' => getenv('AWS_REGION') ?: '',
];
