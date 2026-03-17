-- Drop all Wagtail tables from placements database
-- IMPORTANT: Backup your database before running this script!
-- This will permanently delete all Wagtail-related tables and their data.

SET FOREIGN_KEY_CHECKS = 0;

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
DROP TABLE IF EXISTS wagtaildocs_document;
DROP TABLE IF EXISTS wagtaildocs_uploadeddocument;
DROP TABLE IF EXISTS wagtailembeds_embed;
DROP TABLE IF EXISTS wagtailforms_formsubmission;
DROP TABLE IF EXISTS wagtailimages_image;
DROP TABLE IF EXISTS wagtailimages_rendition;
DROP TABLE IF EXISTS wagtailimages_uploadedimage;
DROP TABLE IF EXISTS wagtailredirects_redirect;
DROP TABLE IF EXISTS wagtailsearch_indexentry;
DROP TABLE IF EXISTS wagtailsearch_query;
DROP TABLE IF EXISTS wagtailsearch_querydailyhits;
DROP TABLE IF EXISTS wagtailusers_userprofile;

SET FOREIGN_KEY_CHECKS = 1;

-- NOTE: The 'workshops' table is NOT a Wagtail table - it's actively used by Laravel
-- Model: App\Models\Workshops
-- Nova Resource: App\Nova\Workshops
-- Migration: 2022_02_10_192642_create_workshops_table.php
-- DO NOT DROP THIS TABLE!
