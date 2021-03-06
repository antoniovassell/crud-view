<?php
namespace CrudView\View\Helper;

use Cake\ORM\Entity;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;
use Cake\Utility\String;
use Cake\View\Helper;

class CrudViewHelper extends Helper
{

    /**
     * List of helpers used by this helper
     *
     * @var array
     */
    public $helpers = ['Form', 'Html', 'Time', 'Paginator'];

    /**
     * Context
     *
     * @var array
     */
    protected $_context = array();

    /**
     * Set context
     *
     * @param \Cake\ORM\Entity $record Entity.
     * @return void
     */
    public function setContext(Entity $record)
    {
        $this->_context = $record;
    }

    /**
     * Get context
     *
     * @return \Cake\ORM\Entity
     */
    public function getContext()
    {
        return $this->_context;
    }

    /**
     * Process a single field into an output
     *
     * @param string $field The field to process.
     * @param array $data The raw entity data.
     * @param array $options Processing options.
     * @return string
     */
    public function process($field, Entity $data, array $options = [])
    {
        $this->setContext($data);

        $value = $this->fieldValue($data, $field);

        $options = (array)$options;
        $options += ['formatter' => null];

        switch ($options['formatter']) {
            case 'element':
                return $this->_View->element($options['element'], compact('field', 'value', 'options'));

            case 'relation':
                return $this->relation($field, $value, $options);

            default:
                return $this->introspect($field, $value, $options);
        }
    }

    /**
     * Get the current field value
     *
     * @param array $data The raw entity data array.
     * @param string $field The field to extract, if null, the field from the entity context is used.
     * @return mixed
     */
    public function fieldValue(Entity $data = null, $field = null)
    {
        if (empty($field)) {
            $field = $this->field();
        }

        if (empty($data)) {
            $data = $this->getContext();
        }

        return $data->get($field);
    }

    /**
     * Returns a formatted output for a given field
     *
     * @param string $field Name of field.
     * @param array $value The value that the field should have within related data.
     * @param array $options Options array.
     * @return string formatted value
     */
    public function introspect($field, $value, array $options = array())
    {
        $output = $this->relation($field, $value, $options);

        if ($output) {
            return $output['output'];
        }

        $type = $this->schema()->columnType($field);

        if ($type === 'boolean') {
            return $this->formatBoolean($field, $value, $options);
        }

        if (in_array($type, array('datetime', 'date', 'timestamp'))) {
            return $this->formatDate($field, $value, $options);
        }

        if ($type == 'time') {
            return $this->formatTime($field, $value, $options);
        }

        return $this->formatString($field, $value, $options);
    }

    /**
     * Format a boolean value for display
     *
     * @param string $field Name of field.
     * @param array $value Value of field.
     * @param array $options Options array.
     * @return string
     */
    public function formatBoolean($field, $value, array $options)
    {
        return (bool)$value ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>';
    }

    /**
     * Format a date for display
     *
     * @param string $field Name of field.
     * @param array $value Value of field.
     * @param array $options Options array.
     * @return string
     */
    public function formatDate($field, $value, array $options)
    {
        return $this->Time->timeAgoInWords($value, $options);
    }

    /**
     * Format a time for display
     *
     * @param string $field Name of field.
     * @param array $value Value of field.
     * @param array $options Options array.
     * @return string
     */
    public function formatTime($field, $value, array $options)
    {
        return $this->Time->nice($value, $options);
    }

    /**
     * Format a string for display
     *
     * @param string $field Name of field.
     * @param array $value Value of field.
     * @param array $options Options array.
     * @return string
     */
    public function formatString($field, $value, array $options)
    {
        return h(String::truncate($value, 200));
    }

    /**
     * Returns a formatted relation output for a given field
     *
     * @param string $field Name of field.
     * @param array $value Value of field.
     * @param array $options Options array.
     * @return mixed Array of data to output, false if no match found
     */
    public function relation($field, $value, array $options = [])
    {
        $associations = $this->associations();
        if (empty($associations['belongsTo'])) {
            return false;
        }

        $data = $this->getContext();
        foreach ($associations['belongsTo'] as $alias => $details) {
            if ($field !== $details['foreignKey']) {
                continue;
            }

            return [
                'alias' => $alias,
                'output' => $this->Html->link($data[$alias][$details['displayField']], [
                    'controller' => $details['controller'],
                    'action' => 'view',
                    $data[$alias][$details['primaryKey']]
                ])
            ];
        }

        return false;
    }

    /**
     * Returns a hidden input for the redirect_url if it exists
     * in the request querystring, view variables, form data
     *
     * @return string
     */
    public function redirectUrl()
    {
        $redirectUrl = $this->request->query('redirect_url');
        $redirectUrlViewVar = $this->getViewVar('redirect_url');

        if (!empty($redirectUrlViewVar)) {
            $redirectUrl = $redirectUrlViewVar;
        } else {
            $redirectUrl = $this->Form->value('redirect_url');
        }

        if (empty($redirectUrl)) {
            return null;
        }

        return $this->Form->hidden('redirect_url', array(
            'name' => 'redirect_url',
            'value' => $redirectUrl,
            'id' => null,
            'secure' => FormHelper::SECURE_SKIP
        ));
    }

    /**
     * Create relation link.
     *
     * @param string $alias Model alias.
     * @param array $relation Relation information.
     * @return string
     */
    public function createRelationLink($alias, $relation)
    {
        return $this->Html->link(
            __d('crud', 'Add {0}', [Inflector::singularize(Inflector::humanize(Inflector::underscore($alias)))]),
            [
                'plugin' => $relation['plugin'],
                'controller' => $relation['controller'],
                'action' => 'add',
                '?' => [
                    $relation['foreignKey'] => $this->getViewVar('primaryKeyValue'),
                    'redirect_url' => $this->request->here
                ]
            ]
        );
    }

    /**
     * Get current model class.
     *
     * @return string
     */
    public function currentModel()
    {
        return $this->getViewVar('modelClass');
    }

    /**
     * Get model schema.
     *
     * @return array
     */
    public function schema()
    {
        return $this->getViewVar('modelSchema');
    }

    /**
     * Get viewVar used for results.
     *
     * @return string
     */
    public function viewVar()
    {
        return $this->getViewVar('viewVar');
    }

    /**
     * Get associations.
     *
     * @return array List of associations.
     */
    public function associations()
    {
        return $this->getViewVar('associations');
    }

    /**
     * Get a view variable.
     *
     * @param string $key View variable to get.
     * @return mixed
     */
    public function getViewVar($key = null)
    {
        return Hash::get($this->_View->viewVars, $key);
    }
}
