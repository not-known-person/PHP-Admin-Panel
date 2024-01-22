<?php
require "includes/header.php";
require "config/config.php";
$query = $conn->query("SELECT topic.id AS id , topic.username AS name ,topic.title AS title , topic.category AS category , topic.body AS body , topic.created_at as created_at , topic.avatar AS avatar , COUNT(replies.topic_id) AS replies_count FROM topic LEFT JOIN replies ON topic.id = replies.topic_id GROUP BY(replies.topic_id);");
$query->execute();
$allTopics = $query->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="main-col">
				<div class="block">
					<h1 class="pull-left">Welcome to Forum</h1>
					<h4 class="pull-right">A Simple Forum</h4>
					<div class="clearfix"></div>
					<hr>
					<ul id="topics">
						<?php foreach ($allTopics as $topic): ?>
							<li class="topic">
								<div class="row">
									<div class="col-md-2">
										<img class="avatar pull-left" src="img/<?php $topic->avatar; ?>" />
									</div>
									<div class="col-md-10">
										<div class="topic-content pull-right">
											<h3><a href="topic.html">
													<?php echo $topic->body; ?>
												</a></h3>
											<div class="topic-info">
												<a href="category.html">
													<?php echo $topic->category; ?>
												</a> >> <a href="profile.html">
													<?php echo $topic->name; ?>
												</a> >> Posted on:
												<?php echo $topic->created_at; ?>
												<span class="color badge pull-right">
													<?php echo $topic->replies_count ?>
												</span>
											</div>
										</div>
									</div>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>

		<?php require "includes/footer.php" ?>