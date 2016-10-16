<?php
/* Template Name: My Curriculum Vitae Page */
?>
<?php get_header();?>
<div class="row cv" >
	<div class="col-md-5">
		<div class="row">
			<div class="col-xs-12 photo">
				<?php 
				$objPhoto = get_field('my_photo');
				?>
				<img src="<?php echo $objPhoto['url']; ?>" title="" alt=""/>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 main-det">
				<h1><?php echo get_field('my_good_name'); ?></h1>
				<h2><?php echo get_field('my_profession'); ?></h2>
					<section class="description">
						<?php echo get_field('about_me'); ?>
					</section>
				</div>
			</div>
			<div class="row">
				<?php 
				$objContact = get_field('contact_details');
				foreach ($objContact  as $key => $value):
					?>
				<div class="col-xs-12">
					<h3><?php echo $value["title"]; ?></h3>
					<div><?php echo $value["content"]; ?></div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<h2>Skills | Tools</h2>
			</div>
			<?php 
			$objSkilsNtools = get_field("skills_and_tools");
			foreach ( $objSkilsNtools as $key => $value ):
				?>
			<div class="col-xs-12">
				<h3><?php echo $value['category_title']; ?></h3>
				<ul>
					<?php foreach ($value["category"] as $ckey => $cvalue):?>
					<li>
						<?php echo $cvalue['title']; ?>
						<div class="progress">
							<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo 10*$cvalue['level']; ?>"
							aria-valuemin="0" aria-valuemax="100" style="width:0%">
							<?php echo $cvalue['level']; ?> / 10
						</div>
					</div>
					
				</li>
			<?php  endforeach;?>

		</ul>
	</div>
<?php endforeach; ?>
<div class="col-xs-12">
	<h3>Personal Interest</h3>
	<section class="description">
		<?php echo get_field('personal_interest'); ?>
	</section>
</div>

</div>
</div>
<div class="col-md-7">
	<div class="row">
		<div class="col-xs-12">
			<h2>Professional Experience</h2>
		</div>
		<div class="col-xs-12">
			<?php $objProfessionalExperience = get_field('professional_experience'); ?>
			<?php foreach ( $objProfessionalExperience as $key => $value): ?>
				<div class="row">
					<div class="col-sm-4">
						<?php echo date('dS M Y',strtotime($value["durations"][0]["start_date"]))." - ".date('dS M Y',strtotime($value["durations"][0]["end_date"]));?>
					</div>
					<div class="col-sm-8">
						<ul>
							<li><?php echo $value['job_title'];?> - <?php echo $value['employer'];?></li>
							<?php if (!empty($value['nature_of_job'])): ?>
								<li><?php echo $value['nature_of_job'];?></li>
							<?php endif ?>
							<?php if (!empty($value['responsibilies'])): ?>
								<li><?php echo $value['responsibilies'];?></li>
							<?php endif ?>
							<?php if (!empty($value['tools_and_technologies'])): ?>
								<li><?php echo $value['tools_and_technologies'];?></li>
							<?php endif ?>
						</ul>
						
					</div>
				</div>
			<?php endforeach ?>
			
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<h2>Academic Project Experiences</h2>
		</div>
		<div class="col-xs-12">
			<?php $objAcademicExperience = get_field('academic_project_experiences'); ?>
			<?php foreach ( $objAcademicExperience as $key => $value):?>
				<div class="row">
					<div class="col-sm-4">
						<?php echo $value["section_one"];?>
					</div>
					<div class="col-sm-8">
						<ul>
							<li><?php echo  $value["section_two"];?></li>
						</ul>						
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<h2>Education</h2>
		</div>
		<div class="col-xs-12">
			<?php $objEducation = get_field('education'); ?>
			<?php foreach ( $objEducation as $key => $value):?>
				<div class="row">
					<div class="col-sm-4">
						<?php echo $value["section_one"];?>
					</div>
					<div class="col-sm-8">
						<ul>
							<li><?php echo  $value["section_two"];?></li>
						</ul>						
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<h2>Extra curricular Activities</h2>
		</div>
		<div class="col-xs-12">
			<?php $objExtraCurricularActivities = get_field('extra_curricular_activities'); ?>
			<?php foreach ( $objExtraCurricularActivities as $key => $value):?>
				<div class="row">
					<div class="col-sm-4">
						<?php echo $value['section_one'];?>
					</div>
					<div class="col-sm-8">
						<ul>
							<?php foreach ($value["section_two"] as $eckey => $ecvalue): ?>
							<li><?php echo $ecvalue["content"];?></li>
							<?php endforeach ?>
							
						</ul>						
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<h2>Personnel Details</h2>
		</div>
		<div class="col-xs-12">
			<?php $objPersonnelDetails = get_field('personnel_details'); ?>
			<?php foreach ( $objPersonnelDetails as $key => $value):?>
				<div class="row">
					<div class="col-xs-4">
						<?php echo $value["category"];?>
					</div>
					<div class="col-xs-8">
						<?php echo  $value["content"];?>						
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<h2>Referees</h2>
		</div>
		<div class="col-xs-12">
			<?php $objReferees = get_field('referees'); ?>
			<?php foreach ( $objReferees as $key => $value):?>
				<div class="row">
					<div class="col-sm-4">
						<?php echo $value["name"];?>
					</div>
					<div class="col-sm-8">
						<ul>
							<?php if (!empty($value["profession"])): ?>
								<li><?php echo  trim($value["profession"]);?></li>
							<?php endif ?>
							<?php if (!empty($value["work_place"])): ?>
								<li><?php echo  trim($value["work_place"]);?></li>
							<?php endif ?>
							<?php if (!empty($value["address"])): ?>
								<li><?php echo  trim($value["address"]);?></li>
							<?php endif ?>
							<?php if (!empty($value["email"])): ?>
								<li><?php echo  trim($value["email"]);?></li>
							<?php endif ?>
							<?php if (!empty($value["telephone"])): ?>
								<li><?php echo  trim($value["telephone"]);?></li>
							<?php endif ?>
						</ul>						
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-12">
					<?php echo get_field('my_agreement');?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="row">
				<div class="col-xs-12 align-left">
					<?php 
					$dt = get_field('sign_date');
					$dt = strtotime($dt);
					echo date('dS M Y',$dt);
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<h3>Download the Resume(s)</h3>
			<ul class="dwn-resume">
				<?php 
				$objResumes = get_field('resumes');
				foreach ($objResumes as $key => $value):?>
					<li class="docdownload" data="<?php echo $value["document"]; ?>"><i class="fa <?php echo $value["icon"]; ?>"></i> <?php echo $value["name"]; ?></li>
				<?php endforeach;?>
				
			</ul>
		</div>
	</div>
</div>

</div>
<?php get_footer();?>