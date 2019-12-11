<?php
require_once('../classes/Attribute_class.php');
$songId = $_GET['id'];

$attributesId = Attribute::getAttributesForId($songId);

$attributesHTML = Attribute::getCurrentAttributesAsList($attributesId);
$attributesHTML = json_encode($attributesHTML);

echo '{"status" : 1, "attributesHTML" : ' . $attributesHTML . '}';
