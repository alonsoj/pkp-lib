<?php

/**
 * @file controllers/informationCenter/form/NewNoteForm.inc.php
 *
 * Copyright (c) 2014-2016 Simon Fraser University Library
 * Copyright (c) 2003-2016 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class NewNoteForm
 * @ingroup informationCenter_form
 *
 * @brief Form to display and post notes on a file
 */


import('lib.pkp.classes.form.Form');

class NewNoteForm extends Form {
	/**
	 * Constructor.
	 */
	function NewNoteForm() {
		parent::Form('controllers/informationCenter/notes.tpl');

		$this->addCheck(new FormValidatorPost($this));
	}

	/**
	 * Return the assoc type for this note.
	 * @return int
	 */
	function getAssocType() {
		assert(false);
	}

	/**
	 * Return the assoc ID for this note.
	 * @return int
	 */
	function getAssocId() {
		assert(false);
	}

	/**
	 * Return the submit note button locale key.
	 * Should be overriden by subclasses.
	 * @return string
	 */
	function getSubmitNoteLocaleKey() {
		assert(false);
	}

	/**
	 * Get the new note form template. Subclasses can
	 * override this method to define other template.
	 * @return string
	 */
	function getNewNoteFormTemplate() {
		return 'controllers/informationCenter/newNoteForm.tpl';
	}

	/**
	 * @copydoc Form::fetch()
	 */
	function fetch($request) {
		$templateMgr = TemplateManager::getManager($request);

		$noteDao = DAORegistry::getDAO('NoteDAO');
		$notes = $noteDao->getByAssoc($this->getAssocType(), $this->getAssocId());
		$templateMgr->assign('notes', $notes);
		$templateMgr->assign('submitNoteText', $this->getSubmitNoteLocaleKey());
		$templateMgr->assign('newNoteFormTemplate', $this->getNewNoteFormTemplate());

		return parent::fetch($request);
	}

	/**
	 * @copydoc Form::readInputData()
	 */
	function readInputData() {
		$this->readUserVars(array(
			'newNote'
		));

	}

	/**
	 * @copydoc Form::execute()
	 */
	function execute($request) {
		$user = $request->getUser();

		$noteDao = DAORegistry::getDAO('NoteDAO');
		$note = $noteDao->newDataObject();

		$note->setUserId($user->getId());
		$note->setContents($this->getData('newNote'));
		$note->setAssocType($this->getAssocType());
		$note->setAssocId($this->getAssocId());

		return $noteDao->insertObject($note);
	}
}

?>
