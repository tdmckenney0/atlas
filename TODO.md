## Installer
* Ensure initial logins are created.
* Ensure that files are copied and directories are created. 

## UserNotifications

* Push Notifications
* Notify Commentors if NodeRevision was created. 
* Have User ID that triggered Notification
* Notifications are deleted after being dismissed. 

## NodeRevisions

* Show Github-style diff when node body is changed. 
* Forks and Recent Common Ancestor. 
* Restore to Node
	* Set created node or overwritten node as parent for revision and all those before it (leave later revs orphaned; creates a fork). 
* Allow user to browse orphanned node revisions 
* Metro-inspired Node pedigree tree. 

## Nodes
* Gzip, Rar, and bzip2 support for importing
* Soft Delete of Nodes
	* BeforeDelete from Table, Push revision, set `node_id` to null.
* Reference other nodes without making it a parent or child; "see also". 
* Readonly flag for nodes
* Table of Contents, click to scroll to page. 

### Reader Mode
* Read Mode have actions on each section and menu. 
* Comments on/off 
* Inline Edit?

## Files
* Ability to add a reference link for source.
	* Include in PDF and exports
	* Ability to "yank" in files based on a passed link. 
		* May need a pretty UI for this too. 
* File size DB field (Files are indexed by hash)
* Normalized file name field to make queries faster. 

## User Interface
* Pinterest-like functionality to pull in files from websites and cite source.
* Browser extension to augment features.
* Section pop-out allowing a user to keep snippets of content available when browsing other pages

## Users
* Removal of Password authentication, instead validate through email link and cookie. Prevents tampering. 

## UserMeetings
* Ability to schedule and remind users of meeting times. 