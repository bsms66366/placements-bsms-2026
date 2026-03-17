-- Drop all Wagtail and Django tables from placements database
-- IMPORTANT: Backup your database before running this script!
-- This will permanently delete all Wagtail and Django-related tables and their data.

SET FOREIGN_KEY_CHECKS = 0;

-- Django Core Framework Tables
DROP TABLE IF EXISTS django_admin_log;
DROP TABLE IF EXISTS django_content_type;
DROP TABLE IF EXISTS django_migrations;
DROP TABLE IF EXISTS django_session;

-- Django Auth Tables
DROP TABLE IF EXISTS auth_group;
DROP TABLE IF EXISTS auth_group_permissions;
DROP TABLE IF EXISTS auth_permission;
DROP TABLE IF EXISTS auth_user;
DROP TABLE IF EXISTS auth_user_groups;
DROP TABLE IF EXISTS auth_user_user_permissions;

-- Wagtail Content Tables (Custom Page Models)
DROP TABLE IF EXISTS content_dashboardpage;
DROP TABLE IF EXISTS content_homepage;
DROP TABLE IF EXISTS content_indexpage;
DROP TABLE IF EXISTS content_note;
DROP TABLE IF EXISTS content_noteimage;
DROP TABLE IF EXISTS content_notepdffile;
DROP TABLE IF EXISTS content_notespage;
DROP TABLE IF EXISTS content_placementlistingpage;
DROP TABLE IF EXISTS content_presentationpage;
DROP TABLE IF EXISTS content_standardpage;

-- Wagtail Core Tables
DROP TABLE IF EXISTS wagtailadmin_admin;
DROP TABLE IF EXISTS wagtailcore_collection;
DROP TABLE IF EXISTS wagtailcore_collectionviewrestriction;
DROP TABLE IF EXISTS wagtailcore_collectionviewrestriction_groups;
DROP TABLE IF EXISTS wagtailcore_comment;
DROP TABLE IF EXISTS wagtailcore_commentreply;
DROP TABLE IF EXISTS wagtailcore_groupapprovaltask;
DROP TABLE IF EXISTS wagtailcore_groupapprovaltask_groups;
DROP TABLE IF EXISTS wagtailcore_groupcollectionpermission;
DROP TABLE IF EXISTS wagtailcore_grouppagepermission;
DROP TABLE IF EXISTS wagtailcore_locale;
DROP TABLE IF EXISTS wagtailcore_modellogentry;
DROP TABLE IF EXISTS wagtailcore_page;
DROP TABLE IF EXISTS wagtailcore_pagelogentry;
DROP TABLE IF EXISTS wagtailcore_pagesubscription;
DROP TABLE IF EXISTS wagtailcore_pageviewrestriction;
DROP TABLE IF EXISTS wagtailcore_pageviewrestriction_groups;
DROP TABLE IF EXISTS wagtailcore_referenceindex;
DROP TABLE IF EXISTS wagtailcore_revision;
DROP TABLE IF EXISTS wagtailcore_site;
DROP TABLE IF EXISTS wagtailcore_task;
DROP TABLE IF EXISTS wagtailcore_taskstate;
DROP TABLE IF EXISTS wagtailcore_workflow;
DROP TABLE IF EXISTS wagtailcore_workflowcontenttype;
DROP TABLE IF EXISTS wagtailcore_workflowpage;
DROP TABLE IF EXISTS wagtailcore_workflowstate;
DROP TABLE IF EXISTS wagtailcore_workflowtask;

-- Wagtail Docs Tables
DROP TABLE IF EXISTS wagtaildocs_document;
DROP TABLE IF EXISTS wagtaildocs_uploadeddocument;

-- Wagtail Embeds Tables
DROP TABLE IF EXISTS wagtailembeds_embed;

-- Wagtail Forms Tables
DROP TABLE IF EXISTS wagtailforms_formsubmission;

-- Wagtail Images Tables
DROP TABLE IF EXISTS wagtailimages_image;
DROP TABLE IF EXISTS wagtailimages_rendition;
DROP TABLE IF EXISTS wagtailimages_uploadedimage;

-- Wagtail Redirects Tables
DROP TABLE IF EXISTS wagtailredirects_redirect;

-- Wagtail Search Tables
DROP TABLE IF EXISTS wagtailsearch_indexentry;
DROP TABLE IF EXISTS wagtailsearch_query;
DROP TABLE IF EXISTS wagtailsearch_querydailyhits;

-- Wagtail Users Tables
DROP TABLE IF EXISTS wagtailusers_userprofile;

SET FOREIGN_KEY_CHECKS = 1;

-- Total: 59 Django/Wagtail tables dropped
-- - Django Core: 4 tables
-- - Django Auth: 6 tables  
-- - Wagtail Content: 10 tables
-- - Wagtail Core: 39 tables

-- NOTES: The following tables are NOT Django/Wagtail tables - they are actively used by Laravel
-- DO NOT DROP THESE TABLES:
-- - workshops (Laravel Model: App\Models\Workshops)
-- - categories / category (Laravel Model: App\Models\Category)
