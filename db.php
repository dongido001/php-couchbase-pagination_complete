<?php 

$authenticator = new \Couchbase\ClassicAuthenticator();
$authenticator->cluster(C_USERNAMAE, C_PASSWORD);

// $authenticator->bucket('Administrator', 'password');

$cluster = new \Couchbase\Cluster(C_URL);

$cluster->authenticate($authenticator);


$bucket = $cluster->openBucket(DEFAULT_BUCKET);


