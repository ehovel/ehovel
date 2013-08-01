<div class="aside">
        	
            <!--sidenav-->
            <div class="sidenav">
                <h2 class="h2">Categories</h2>
                <ul class="sidenav_list">
                <?php $columns = BES::helper('column')->get_columns($site_id);
                	foreach ($columns as $column){
                ?>
                <li class="sidenav_item"><a href="<?php echo $column->url;?>" class="sidenav_main"><?php echo $column->name;?></a></li>
                <?php }?>
<!--                    <li class="sidenav_item sidenav_item_current"><span class="sidenav_main">Food Machinery</span>-->
<!--                        <ul class="sidenav_sublist">-->
<!--                            <li><a href="#">Food Machinery</a></li>-->
<!--                            <li><a href="#">Warehousing Project</a></li>-->
<!--                            <li><a href="#">Food Machinery</a></li>-->
<!--                            <li><a href="#">Food Machinery</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
                </ul>
            </div>
            
            <!--aside_banner-->
            <div class="free_shipping">
            	<script language="javascript" src="/ads/show_poster?id=16&type=banner&spaceid=14"></script>
            </div>
            <div class="aside_bestsellers">
            <?php $collection = BES::helper('Product')->collection('best_seller_index',5);
            	if (!empty($collection)){?>
            	<h2 class="h2">Best Sellers</h2>
                <ul class="seller_list">
                <?php foreach ($collection['products'] as $collection_product){?>
                	<li>
                    	<div class="pic"><a href="<?php echo $collection_product['url'];?>" class="img60x60"><img alt="<?php echo $collection_product['name'];?>" src="<?php echo BES::upload_url($collection_product['image'], '60x60');?>" /></a></div>
                        <div class="info">
                        	<h5><a href="<?php echo $collection_product['url'];?>" title=""><?php echo BES::helper('tool')->my_substr($collection_product['name'],20);?></a></h5>
                            <p class="price">
                            <?php if ('ACCURATE'==$collection_product['price_show_type']){?>
                            	<?php if ($collection_product['is_discount']=='Y'){?>
                            	<em><?php echo $currency_sign.$collection_product['discount_price'];?></em>
                            	<del><?php echo $currency_sign.$collection_product['price'];?></del>
                            	<?php }else{?>
                            	<em><?php echo $currency_sign.$collection_product['price'];?></em>
                            	<?php }?>
                            <?php }elseif ('RANGE'==$collection_product['price_show_type']){?>
                                <em><?php echo __('Price');?>: <?php echo $currency_sign.$collection_product['min_price'].' - '.$currency_sign.$collection_product['max_price'];?></em>
                           	<?php }else{?>
                            	<em><?php echo __('No Accurate Price');?></em>
                            <?php }?>
                            </p>
                        </div>
                    </li>
                <?php }?>
                </ul>
                <?php }?>
            </div>
            
            <!--free_shipping-->
            <div class="free_shipping">
            	<script language="javascript" src="/ads/show_poster?id=17&type=banner&spaceid=15"></script>
            </div>
            
            <!--new_gear-->
            <div class="new_gear">
            	<script language="javascript" src="/ads/show_poster?id=18&type=banner&spaceid=16"></script>
            </div>
            
        </div>
