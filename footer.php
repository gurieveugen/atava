
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

<?php wp_footer(); ?>
</body>
</html>
