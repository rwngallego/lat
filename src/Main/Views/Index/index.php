<?php render_view("Main:Layouts:header.php"); ?>

<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed
	tortor vitae felis mollis dapibus id sit amet lectus. Maecenas
	vulputate sem in lectus eleifend vulputate. Class aptent taciti
	sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
	Phasellus ullamcorper magna in leo faucibus pretium.</h3>
<h2 class="center-text">
	<a href="<?php echo get_url('login') ?>">Login</a>
</h2>
<p class="center-text">
	<img src="<?php asset('img/timetable.jpg');?>" width="300" height="220"
		alt="Timetable" />
</p>

<?php render_view("Main:Layouts:footer.php")?>