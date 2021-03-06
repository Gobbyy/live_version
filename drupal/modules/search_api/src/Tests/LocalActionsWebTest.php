<?php

/**
 * @file
 * Contains \Drupal\search_api\Tests\LocalActionsWebTest.
 */

namespace Drupal\search_api\Tests;

use Drupal\system\Tests\Menu\LocalActionTest;

/**
 * Tests that local actions are available.
 *
 * @group search_api
 */
class LocalActionsWebTest extends LocalActionTest {

  /**
   * Modules to enable for this test.
   *
   * @var string[]
   */
  public static $modules = array('search_api');

  /**
   * The administrator account to use for the tests.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $adminUser;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
    // Create users.
    $this->adminUser = $this->drupalCreateUser(array('administer search_api', 'access administration pages'));
    $this->drupalLogin($this->adminUser);
  }

  /**
   * {@inheritdoc}
   */
  public function testLocalAction() {
    // @todo Merge into OverviewPageTest or IntegrationTest? Or get rid of the
    //   triple loop, or do something useful with it.
    foreach ($this->getSearchAPIPageRoutes() as $routes) {
      foreach ($routes as $route) {
        $actions = array(
          // entity.search_api_server.add_form
          '/admin/config/search/search-api/add-server' => 'Add server',
          // entity.search_api_index.add_form
          '/admin/config/search/search-api/add-index' => 'Add index',
        );
        $this->drupalGet($route);
        $this->assertLocalAction($actions);
      }
    }
  }

  /**
   * Provides a list of routes to test.
   */
  public function getSearchAPIPageRoutes() {
    return array(
      // search_api.overview
      array('/admin/config/search/search-api'),
    );
  }

}
