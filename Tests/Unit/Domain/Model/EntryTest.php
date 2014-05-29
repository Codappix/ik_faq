<?php

namespace IngoKasch\IkFaq\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Ingo Kasch <ingo@loom-consulting.com>, LOOM Consulting
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \IngoKasch\IkFaq\Domain\Model\Entry.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Ingo Kasch <ingo@loom-consulting.com>
 */
class EntryTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \IngoKasch\IkFaq\Domain\Model\Entry
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \IngoKasch\IkFaq\Domain\Model\Entry();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getQuestionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getQuestion()
		);
	}

	/**
	 * @test
	 */
	public function setQuestionForStringSetsQuestion() {
		$this->subject->setQuestion('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'question',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getQuestionImageReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getQuestionImage()
		);
	}

	/**
	 * @test
	 */
	public function setQuestionImageForFileReferenceSetsQuestionImage() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setQuestionImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'questionImage',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnswereReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAnswere()
		);
	}

	/**
	 * @test
	 */
	public function setAnswereForStringSetsAnswere() {
		$this->subject->setAnswere('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'answere',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnswereImageReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getAnswereImage()
		);
	}

	/**
	 * @test
	 */
	public function setAnswereImageForFileReferenceSetsAnswereImage() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setAnswereImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'answereImage',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCategoriesReturnsInitialValueForCategory() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getCategories()
		);
	}

	/**
	 * @test
	 */
	public function setCategoriesForObjectStorageContainingCategorySetsCategories() {
		$category = new \IngoKasch\IkFaq\Domain\Model\Category();
		$objectStorageHoldingExactlyOneCategories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneCategories->attach($category);
		$this->subject->setCategories($objectStorageHoldingExactlyOneCategories);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneCategories,
			'categories',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addCategoryToObjectStorageHoldingCategories() {
		$category = new \IngoKasch\IkFaq\Domain\Model\Category();
		$categoriesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$categoriesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($category));
		$this->inject($this->subject, 'categories', $categoriesObjectStorageMock);

		$this->subject->addCategory($category);
	}

	/**
	 * @test
	 */
	public function removeCategoryFromObjectStorageHoldingCategories() {
		$category = new \IngoKasch\IkFaq\Domain\Model\Category();
		$categoriesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$categoriesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($category));
		$this->inject($this->subject, 'categories', $categoriesObjectStorageMock);

		$this->subject->removeCategory($category);

	}
}
