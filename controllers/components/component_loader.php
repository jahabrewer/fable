<?php
/**
* This is a compnent that is used to load other 
* @author geoff
*/
class ComponentLoaderComponent {
	/**
	* The instance of the controller.
	* @var AppController
	*/
	private $__controller;

	/**
	* Component callbacks that have been executed.
	* @var array
	*/
	private $__callbacks = array();

	/**
	* The initialize method. Used to populate the instance of the controller, and to
	* track the fact that the initialize method has been called.
	* @access public
	* @param AppController $c
	*/
	public function initialize ($c) {
		$this->__callbacks[] = 'initialize';
		$this->_controller = $c;

		// Populate properties the Component would expect.
		$this->plugin = $c->plugin;
		$this->name = get_class($this);
		$this->base = $c->base;
	}

	/**
	* Used to track that the startup method has been called.
	* @access public
	* @return void
	*/
	public function startup () {
		$this->__callbacks[] = 'startup';
	}

	/**
	* Used to track that the beforeRender method has been called.
	* @access public
	* @return void
	*/
	public function beforeRender () {
		$this->__callbacks[] = 'beforeRender';
	}

	/**
	* Used to track that the beforeRedirect method has been called.
	* @access public
	* @return void
	*/
	public function beforeRedirect () {
		$this->__callbacks[] = 'beforeRedirect';
	}

	/**
	* Used to track that the shutdown method has been called.
	* @access public
	* @return void
	*/
	public function shutdown () {
		$this->__callbacks[] = 'shutdown';
	}

	/**
	* The magical function that actually imports and loads the components. Components
	* to be loaded can be supplied as multiple arguments, or as a single array of components.
	* @access public
	* @param array|string
	* @return void
	*/
	public function load ($component, $settings = array()) {
		// Get the components.
		if (!is_array($component)) {
			$_components = array($component => $settings);
		} else {
			$_components = $component;
		}

		// Ensure we have the correct format.
		$components = array();
		foreach ($_components as $name => $settings) {
			if (!is_array($settings)) {
				$components[$settings] = array();
			} else {
				$components[$name] = $settings;
			}
		}

		// Cycle through components to load.
		foreach ($components as $componentName => $componentSettings) {
			// Build up the component name, as well as the actual class name.
			list($plugin, $className) = pluginSplit($componentName, true);
			$componentName = $className;
			$className = "{$className}Component";

			// Check whether the component is already loaded.
			if (isset($this->_controller->{$componentName}) && $this->_controller->{$componentName} instanceof $className) {
				continue;
			}

			// If the class doesn't exist, attempt to load it. If it can't be loaded,
			// continue with the next one.
			if (!class_exists($className) && !App::import('Component', $plugin . $componentName)) {
				continue;
			}

			// Only attempt to load the component if the class is found.
			if (class_exists($className)) {
				$_component = new $className();
				if (isset($_component->components)) {
					// Populate component's properties.
					$_component->plugin = $this->plugin;
					$_component->name = get_class($_component);
					$_component->base=  $this->base;

					// Init the component.
					$this->_controller->Component->init($_component);
				}

				// Cycle through the callbacks that have already been called.
				foreach ($this->__callbacks as $methodName) {
					if (method_exists($_component, $methodName)) {
						if ($methodName == 'initialize') {
							$_component->{$methodName}($this->_controller, $componentSettings);
						} else {
							$_component->{$methodName}($this->_controller);
						}
					}
				}

				// Populate the controller.
				$this->_controller->{$componentName} = $_component;
			}
		}
	}
}
?>
