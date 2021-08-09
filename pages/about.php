<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	<title>HS Courser | About</title>
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
			list-style: none;
			text-decoration: none;
		}
		.page_title{
			margin: 40px;
			text-align: center;
		}
		.page_title span{
			border-bottom: 3px solid cornflowerblue;
			font-size: 50px;
			padding: 10px;
			font-family: 'Montserrat', sans-serif;
		}
		.container{
			width: 100%;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.wrapper{
			width: 60%;
			justify-content: center;
			font-family: 'Montserrat', sans-serif;
			border: 3px solid cornflowerblue;
			padding: 30px;
			margin-bottom: 60px;
		}
		.section_title{
			text-align: center;
			margin-bottom: 30px;
			font-size: 40px;
		}
		.about_ul, .about_p{
			margin-bottom: 40px;
			font-size: 20px;
		}
		p{
			font-size: 20px;
		}
	</style>
</head>
<body>
	<header>
		<?php require "header.php"; ?>
		<ul class="navigation">
			<a href="/contact"><li><div>Contact</div></li></a>
			<a href="/"><li><div>Back To Home</div></li></a>
		</ul>
	</header>
	<main>
		<div class="page_title">
			<span>About HS Courser</span>
		</div>
		<br><br>
		<div class="container">
			<div class="wrapper">
				<div class="section_title">The Goal</div>
				<ul class="about_ul">
					<li>One goal of HS Courser is to provide high school students with a convenient (more convenient than posting stories on Instagram/Snapchat and messaging people directly) method of seeing their friends' schedules at the beginning of and during a school year. Schedules will include classes and periods. Another goal of HS Courser is to help high school students make new friends based on the classes and classmates they have.</li>
				</ul>
				<div class="section_title">Your Journey</div>
				<ul class="about_ul">
					<li>Step 1: You create a free account, login, add your schedule, and then add different friends.</li>
					<br>
					<li>Step 2: Once you add a friend, you can compare their schedule with yours and clearly see which classes you and your friend share in common.</li>
					<br>
					<li>Step 3: You can go to your specific periods' pages, where you can see specific classmates. You can see the classmates who are your friends, and you can compare their schedule with yours (another place to do so). However, you can also see the classmates who are not your friends.</li>
					<br>
					<li>Step 4: For the classmates who are not your friends, you can add them as friends (individually) or you can add them to your "Goals."</li>
					<br>
					<li>Step 5: Your goals remind you who to add and who to introduce yourself to using an external messaging platform, because one goal of your journey is to make new friends! You can mark your goals as completed at any time.</li>
				</ul>
				<div class="section_title">Why Is It More Efficient</div>
				<p class="about_p">Using HS Courser is more efficient than using any forms of social media for a couple important reasons. For one, it is a more controlled way of seeing what classes your friends are taking. You may not see Instagram or Snapchat stories/posts or you may just forget to message a friend. With HS Courser, you can see everyone who has an account and look up specific people. Furthermore, it will be less likely for you to miss anybody because once you add friends, you can see a list of your friends, and you can make sure that you checked all of your friends' schedules.</p>
				<p class="about_p">On top of that, with Instagram, Snapchat, or messaging people directly, you most likely will forget if you have asked a friend about their schedule, or you will forget if you share any classes with that friend. With HS Courser, you can see which periods you share with your specific friends. For example, if you have English III Fourth Period, you can go to your Fourth Period page and see who you have it with.</p>
				<p class="about_p">Basically, when you use different kinds of social media, you are manually asking or telling people about shared classes. Because of that, you have to do more work and ask loads of people, and, as a result, you will forget a lot about who you share periods with. With HS Courser, all of those problems go away, as it is a platform to see your friends' schedules. You simply add your own schedule, compare your schedule with friends, and obtain a list of the friends who are your classmates for specific periods. It is convenient and efficient.</p>
				<p class="about_p">Finally, who does not like making new friends!? This platform is a great way to make new friends, as it allows you to see classmates who you may not be familiar with and encourages you to talk to them.</p>
				<p class="about_p">All in all, HS Courser is a fantastic way to efficiently and conveniently see which friends you have classes with and make new friends!</p>
			</div>
		</div>
	</main>
	<footer>
		<?php require 'footer.php';?>
	</footer>
</body>
</html>