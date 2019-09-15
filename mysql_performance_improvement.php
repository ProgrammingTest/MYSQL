<?php


// 1. Index All Columns Used in 'where', 'order by', and 'group by' Clauses and on clauses in join table

// 2. Use MySQL full-text search (FTS) because it is far much faster than queries using wildcard characters.

//    FTS can also bring better and relevant results when you are searching a huge database.

//    we must use full-text search index to all the tables used in where clause, below is the MySQL example command:

//    mysql>Alter table jobs ADD FULLTEXT (name);

//    mysql>Alter table JobCategories ADD FULLTEXT (name);

//    And so on....

// 3. In where clause public_status looks ambitious without mentioning tablename, it should be tablename.public_status


// Below is the changes in the task query

$sql="SELECT Jobs.id AS `Jobs    id`, Jobs.name AS `Jobs name`, Jobs.media_id AS `Jobs media_id`,
Jobs.job_category_id AS `Jobs job_category_id`, Jobs.job_type_id AS `Jobs job_type_id`, Jobs.description AS `Jobs  description`, Jobs.detail AS `Jobs detail`,
Jobs.business_skill AS `Jobs business_skill`, Jobs.knowledge AS `Jobs knowledge`, Jobs.location AS `Jobs    location`, Jobs.activity AS `Jobs activity`,
Jobs.academic_degree_doctor AS `Jobs academic_degree_doctor`, Jobs.academic_degree_master AS `Jobs academic_degree_master`, Jobs.academic_degree_professional AS `Jobs academic_degree_professional`, Jobs.academic_degree_bachelor AS `Jobs academic_degree_bachelor`, Jobs.salary_statistic_group AS `Jobs salary_statistic_group`, Jobs.salary_range_first_year AS `Jobs salary_range_first_year`, Jobs.salary_range_average AS `Jobs salary_range_average`, Jobs.salary_range_remarks AS `Jobs salary_range_remarks`,
Jobs.restriction AS `Jobs   restriction`, Jobs.estimated_total_workers AS `Jobs estimated_total_workers`, Jobs.remarks AS `Jobs remarks`,
Jobs.url AS `Jobs url`,
Jobs.seo_description AS `Jobs seo_description`, Jobs.seo_keywords AS `Jobs seo_keywords`, Jobs.sort_order AS `Jobs sort_order`, Jobs.publish_status AS `Jobs publish_status`, Jobs.version AS `Jobs    version`, Jobs.created_by AS `Jobs created_by`, Jobs.created AS `Jobs created`,
Jobs.modified AS `Jobs modified`, Jobs.deleted AS `Jobs deleted`,
 
JobCategories.id AS `JobCategories id`, JobCategories.name AS `JobCategories name`, JobCategories.sort_order AS `JobCategories sort_order`, JobCategories.created_by AS `JobCategories created_by`, JobCategories.created AS `JobCategories created`, JobCategories.modified AS `JobCategories modified`, JobCategories.deleted AS `JobCategories deleted`, JobTypes.id AS `JobTypes id`,
JobTypes.name AS `JobTypes name`, JobTypes.job_category_id AS `JobTypes job_category_id`, JobTypes.sort_order AS `JobTypes sort_order`, JobTypes.created_by AS `JobTypes created_by`, JobTypes.created AS `JobTypes created`, JobTypes.modified AS `JobTypes modified`, JobTypes.deleted AS `JobTypes deleted`
FROM jobs Jobs
LEFT JOIN jobs_personalities JobsPersonalities ON Jobs.id = (JobsPersonalities.job_id)
LEFT JOIN personalities Personalities
ON (Personalities.id = (JobsPersonalities.personality_id) AND (Personalities.deleted) IS NULL)
LEFT JOIN jobs_practical_skills JobsPracticalSkills ON Jobs.id = (JobsPracticalSkills.job_id)
LEFT JOIN practical_skills PracticalSkills
ON (PracticalSkills.id = (JobsPracticalSkills.practical_skill_id) AND (PracticalSkills.deleted) IS NULL)
LEFT JOIN jobs_basic_abilities JobsBasicAbilities ON Jobs.id = (JobsBasicAbilities.job_id)
LEFT JOIN basic_abilities BasicAbilities
ON (BasicAbilities.id = (JobsBasicAbilities.basic_ability_id) AND (BasicAbilities.deleted) IS NULL)
LEFT JOIN jobs_tools JobsTools ON Jobs.id = (JobsTools.job_id)
LEFT JOIN affiliates Tools ON (Tools.type = 1
AND Tools.id = (JobsTools.affiliate_id) AND (Tools.deleted) IS NULL)
LEFT JOIN jobs_career_paths JobsCareerPaths ON Jobs.id = (JobsCareerPaths.job_id)
LEFT JOIN affiliates CareerPaths ON (CareerPaths.type = 3
AND CareerPaths.id = (JobsCareerPaths.affiliate_id) AND (CareerPaths.deleted) IS NULL)
LEFT JOIN jobs_rec_qualifications JobsRecQualifications ON Jobs.id = (JobsRecQualifications.job_id)
LEFT JOIN affiliates RecQualifications ON (RecQualifications.type = 2
AND RecQualifications.id = (JobsRecQualifications.affiliate_id)
 
AND (RecQualifications.deleted) IS NULL)
LEFT JOIN jobs_req_qualifications JobsReqQualifications ON Jobs.id = (JobsReqQualifications.job_id)
LEFT JOIN affiliates ReqQualifications ON (ReqQualifications.type = 2
AND ReqQualifications.id = (JobsReqQualifications.affiliate_id) AND (ReqQualifications.deleted) IS NULL)
INNER JOIN job_categories JobCategories
ON (JobCategories.id = (Jobs.job_category_id) AND (JobCategories.deleted) IS NULL)
INNER JOIN job_types JobTypes
ON (JobTypes.id = (Jobs.job_type_id) AND (JobTypes.deleted) IS NULL)
WHERE (
    (match(JobCategories.name,
 JobTypes.name,
 Jobs.name ,
 Jobs.description , 
 Jobs.detail ,
 Jobs.business_skill , 
 Jobs.knowledge , 
 Jobs.location ,
 Jobs.activity ,
 Jobs.salary_statistic_group , 
 Jobs.salary_range_remarks , 
 Jobs.restriction ,
 Jobs.remarks ,
 Personalities.name , 
 PracticalSkills.name , 
 BasicAbilities.name , 
 Tools.name ,
 CareerPaths.name ,
 RecQualifications.name , 
 ReqQualifications.name )against('キャビンアテンダント')) 
AND publish_status = 1
AND (Jobs.deleted) IS NULL) 
GROUP BY Jobs.id
ORDER BY Jobs.sort_order desc, Jobs.id DESC LIMIT 0,50";
