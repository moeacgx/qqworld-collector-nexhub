<?php
 namespace QQWorld\Eav\Api; interface AttributeSetManagementInterface { public function create( $entityTypeCode, \QQWorld\Eav\Api\Data\AttributeSetInterface $attributeSet, $skeletonId ); } 