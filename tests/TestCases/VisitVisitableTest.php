<?php

namespace Cyrildewit\PageViewCounter\Tests\TestCases;

use Carbon\Carbon;
use Cyrildewit\PageViewCounter\Tests\TestCase;
use Cyrildewit\PageViewCounter\SessionHistory;

class VisitVisitableTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /** @test */
    // public function it_can() {
    //     runkit_method_add(
    //         'VisitVisitableTest',
    //         'add',
    //         '$num1, $num2',
    //         'return $num1 + $num2;',
    //         RUNKIT_ACC_PUBLIC
    //     );
    //
    //     return $this->add(1, 5);
    // }

    // /** @test */
    // public function it_can_store_new_visits_into_the_database()
    // {
    //     // Store new visit
    //     $this->testTaskModel->addVisit();
    //     $hasFirstVisit = ($this->testTaskModel->page_visits === 1 ? true : false);
    //
    //     // Store new visit
    //     $this->testTaskModel->addVisit();
    //     $hasSecondVisit = ($this->testTaskModel->page_visits === 2 ? true : false);
    //
    //     // Store new visit
    //     $this->testTaskModel->addVisit();
    //     $hasFirstVisit = ($this->testTaskModel->page_visits_formatted === '3' ? true : false);
    //
    //     // Store new visit
    //     $this->testTaskModel->addVisit();
    //     $hasSecondVisit = ($this->testTaskModel->page_visits_formatted === '4' ? true : false);
    //
    //     // Check first and second visits
    //     $this->assertTrue($hasFirstVisit);
    //     $this->assertTrue($hasSecondVisit);
    // }

    // /** @test */
    // public function it_can_store_new_visits_with_expiry_dates_into_the_database()
    // {
    //     $uniqueKey = (new SessionHistory())->fromCamelCaseToDashes(class_basename($this->testTaskModel));
    //     $visitable_id = $this->testTaskModel->id;
    //
    //     // Store new visit
    //     $this->testTaskModel->addVisitThatExpiresAt(Carbon::now()->addSeconds(40));
    //
    //     $hasNewVisit = ($this->testTaskModel->page_visits === 1 ? true : false);
    //     $this->assertTrue($hasNewVisit);
    //
    //     $hasNewVisit = ($this->testTaskModel->page_visits_formatted === '1' ? true : false);
    //     $this->assertTrue($hasNewVisit);
    //
    //     $hasNewVisitInSession = (new SessionHistory())->isItemVisited($uniqueKey, $visitable_id);
    //     $this->assertTrue($hasNewVisitInSession);
    // }
}
