
	</div>
</div>
<?php 
$cat = intval(get_post_meta( get_the_id(), 'p_info_category', true ));
$castle = intval(get_post_meta( get_the_id(), 'p_castle_category', true ));
echo Coverflow::getCoverflow($cat);
echo Castles::getCastles($castle);
?>
<div id="footer">
	<pre class="txt">
		Litatemporunt laut verferemo beritatem aut quia sit repeliq uiaerspel earcianissi omnimi 
magnatur sed modi quat paruptatet accae consero erum, id uta
	</pre>
</div>
<a href="#" class="chat-btn"></a>
<?php wp_footer(); ?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-534d768f44b3907d" async="async"></script>
</body>
</html>
