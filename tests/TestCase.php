<?php

namespace Cyrildewit\PageViewCounter\Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Database\Schema\Blueprint;
use Orchestra\Testbench\TestCase as Orchestra;
use Cyrildewit\PageViewCounter\Test\Models\Task;
use Cyrildewit\PageViewCounter\PageViewCounterServiceProvider;

abstract class TestCase extends Orchestra
{
    /** @var \Cyrildewit\PageViewCounter\Test\Models\Task */
    protected $testTaskModel;

    public function setUp()
    {
        parent::setUp();

        $this->setUpDatabase($this->app);

        $this->testTaskModel = Task::find(1);
    }

    public function tearDown()
    {
        Artisan::call('migrate:reset');

        parent::tearDown();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            PageViewCounterServiceProvider::class,
        ];
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * Set up the database.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function setUpDatabase($app)
    {
        $schemaBuilder = $app['db']->connection()->getSchemaBuilder();

        $schemaBuilder->create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });

        $schemaBuilder->create('page_visits', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->bigInteger('visitable_id')->unsigned();
            $table->string('visitable_type');

            $table->timestamps();
        });

        // Including the package migration file
        include_once __DIR__.'/../database/migrations/create_page_visit_table.php.stub';

        // Running the migration file
        (new \CreatePageVisitsTable())->up();

        $task = new Task();
        $task->title = 'Write a story';
        $task->save();

        $task = new Task();
        $task->title = 'Walk a marathon';
        $task->save();

        $task = new Task();
        $task->title = 'Create a Laravel package';
        $task->save();
    }

    /**
     * Refresh the test visitable model.
     */
    public function refreshTestVisitableModel()
    {
        $this->testTaskModel = $this->testTaskModel->fresh();
    }
}
