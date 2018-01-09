<?php if (!defined('THINK_PATH')) exit();?><iiclude file="Index/header" />
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-md-9">

					<div class="news-list">
						<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dl>
								<dt><?php echo ($vo["title"]); ?></dt>
								<dd class="news-img">
									<a href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><img width="200" height="120" src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["title"]); ?>"></a>
								</dd>
								<dd class="news-intro">
									<?php echo ($vo["description"]); ?>
								</dd>
								<dd class="news-info">
									<?php echo ($vo["keywords"]); ?> <span><?php echo (date("Y-m-d H:i:s",$vo["create_time"])); ?></span> 阅读(<?php echo ($vo["count"]); ?>)
								</dd>
							</dl><?php endforeach; endif; else: echo "" ;endif; ?>
					<?php echo ($result['pageres']); ?>

					</div>
					
					<!--<button id="sing_more" type="button" class="btn btn-primary btn-lg btn-block sing_display_none">更多</button>-->
				</div>
				<!--start right -->

				<div class="col-sm-3 col-md-3">
  <div class="right-title">
    <h3>文章排行</h3>
    <span>TOP ARTICLES</span>
  </div>

  <div class="right-content">
    <ul>
      <?php if(is_array($result)): $k = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><li class="num<?php echo ($k); ?> curr">
        <a target="_blank" href="/index.php?c=detail&id=<?php echo ($vo["news_id"]); ?>"><?php echo ($vo["small_title"]); ?></a>
        <?php if($k == 1): ?><div class="intro">
          <?php echo ($vo["description"]); ?>
        </div><?php endif; ?>
      </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
  </div>
  <?php if(is_array($thumb)): $k = 0; $__LIST__ = $thumb;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="right-hot">
    <a target="_blank" href="<?php echo ($vo["url"]); ?>"><img src="<?php echo ($vo["thumb"]); ?>" alt="<?php echo ($vo["name"]); ?>"></a>
  </div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
				<!-- end right-->
			</div>
		</div>
	</section>
</body>
<script src="/Public/js/jquery.js"></script>
<script>
	
</script>
<script src="/Public/js/home/common.js"></script>
</html>