<?php
 namespace QQWorld\ConfigurableProduct\Pricing\Price; interface PriceResolverInterface { public function resolvePrice(\QQWorld\Framework\Pricing\SaleableInterface $product); } 