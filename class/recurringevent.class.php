<?php
/* Copyright (C) 2019 ATM Consulting <support@atm-consulting.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if (!class_exists('SeedObject'))
{
    /**
     * Needed if $form->showLinkedObjectBlock() is call or for session timeout on our module page
     */
    define('INC_FROM_DOLIBARR', true);
    require_once dirname(__FILE__).'/../config.php';
}


class RecurringEvent extends SeedObject
{
    /** @var string $table_element Table name in SQL */
    public $table_element = 'recurringevent';

    /** @var string $element Name of the element (tip for better integration in Dolibarr: this value should be the reflection of the class name with ucfirst() function) */
    public $element = 'recurringevent';

    /** @var int $isextrafieldmanaged Enable the fictionalises of extrafields */
    public $isextrafieldmanaged = 0;

    /** @var int $ismultientitymanaged 0=No test on entity, 1=Test with field entity, 2=Test with link by societe */
    public $ismultientitymanaged = 1;

    /**
     * 1. 'type' is the field format.
     * 2. 'label' the translation key.
     * 3. 'enabled' is a condition when the field must be managed.
     * 4. 'visible' says if field is visible in list (Examples: 0=Not visible, 1=Visible on list and create/update/view forms, 2=Visible on list only, 3=Visible on create/update/view form only (not list), 4=Visible on list and update/view form only (not create). Using a negative value means field is not shown by default on list but can be selected for viewing)
     *  'noteditable' says if field is not editable (1 or 0)
     *  'notnull' is set to 1 if not null in database. Set to -1 if we must set data to null if empty ('' or 0).
     *  'default' is a default value for creation (can still be replaced by the global setup of default values)
     *  'index' if we want an index in database.
     *  'foreignkey'=>'tablename.field' if the field is a foreign key (it is recommanded to name the field fk_...).
     *  'position' is the sort order of field.
     *  'searchall' is 1 if we want to search in this field when making a search from the quick search button.
     *  'isameasure' must be set to 1 if you want to have a total on list for this field. Field type must be summable like integer or double(24,8).
     *  'css' is the CSS style to use on field. For example: 'maxwidth200'
     *  'help' is a string visible as a tooltip on field
     *  'comment' is not used. You can store here any text of your choice. It is not used by application.
     *  'showoncombobox' if value of the field must be visible into the label of the combobox that list record
     *  'arraykeyval' to set list of value if type is a list of predefined values. For example: array("0"=>"Draft","1"=>"Active","-1"=>"Cancel")
     */

    public $fields = array(

        'entity' => array(
            'type' => 'integer',
            'label' => 'Entity',
            'enabled' => 1,
            'visible' => 0,
            'default' => 1,
            'notnull' => 1,
            'index' => 1,
            'position' => 10
        ),

        'fk_actioncomm' => array(
            'type' => 'integer:Actioncomm:comm/action/class/actioncomm.class.php',
            'label' => 'Actioncomm',
            'visible' => 1,
            'enabled' => 1,
            'position' => 20,
            'index' => 1,
        ),

        'fk_actioncomm_master' => array(
            'type' => 'integer:Actioncomm:comm/action/class/actioncomm.class.php',
            'label' => 'ActioncommMaster',
            'visible' => 1,
            'enabled' => 1,
            'position' => 30,
            'index' => 1,
        ),

        'frequency' => array(
            'type' => 'integer',
            'label' => 'Frequency',
            'visible' => 1,
            'enabled' => 1,
            'position' => 40,
            'index' => 0,
        ),

        'frequency_unit' => array(
            'type' => 'varchar(50)',
            'label' => 'FrequencyUnit',
            'visible' => 1,
            'enabled' => 1,
            'position' => 50,
            'index' => 0,
        ),

        'weekday_repeat' => array(
            'type' => 'array',
            'label' => 'WeekdayRepeat',
            'visible' => 1,
            'enabled' => 1,
            'position' => 60,
            'index' => 0,
            'help' => 'UsedOnlyIfUnitIsWeek',
        ),

        'end_type' => array(
            'type' => 'varchar(30)',
            'label' => 'EndType',
            'visible' => 1,
            'enabled' => 1,
            'position' => 70,
            'index' => 0,
        ),

        'end_date' => array(
            'type' => 'date',
            'label' => 'EndType',
            'visible' => 1,
            'enabled' => 1,
            'position' => 80,
            'index' => 0,
        ),

        'end_occurrence' => array(
            'type' => 'integer',
            'label' => 'EndOccurrence',
            'visible' => 1,
            'enabled' => 1,
            'position' => 90,
            'index' => 0,
        ),

        'actioncomm_datep' => array(
            'type' => 'date',
            'label' => 'ActioncommDatep',
            'visible' => 1,
            'enabled' => 1,
            'position' => 150,
            'index' => 0,
        ),

        'actioncomm_datef' => array(
            'type' => 'date',
            'label' => 'ActioncommDatef',
            'visible' => 1,
            'enabled' => 1,
            'position' => 160,
            'index' => 0,
        ),

//        'fk_user_valid' =>array(
//            'type' => 'integer',
//            'label' => 'UserValidation',
//            'enabled' => 1,
//            'visible' => -1,
//            'position' => 512
//        ),

        'import_key' => array(
            'type' => 'varchar(14)',
            'label' => 'ImportId',
            'enabled' => 1,
            'visible' => -2,
            'notnull' => -1,
            'index' => 0,
            'position' => 1000
        ),

    );

    /** @var int $entity Entity id */
    public $entity;
    /** @var int $fk_actioncomm Actioncomm id */
    public $fk_actioncomm;
    /** @var int $fk_actioncomm_master Actioncomm id, if 0 the current object is the master */
    public $fk_actioncomm_master;
    /** @var int $frequency value of frequency */
    public $frequency;
    /** @var string $frequency_unit can be 'day' || 'week' || 'month' || 'year' */
    public $frequency_unit;
    /** @var string $weekday_repeat serialization of weekday (PHP int value) separate by comma, ex. [0,2] for Sunday and Tuesday */
    public $weekday_repeat;
    /** @var string $end_type can be 'date' || 'occurrence' */
    public $end_type;
    /** @var date $end_date if $end_type is 'date' then this attribute contain the limit date to create the recurring */
    public $end_date;
    /** @var int $end_occurrence if $end_type is 'occurrence' then this attribute contain number to limit the creation of recurring */
    public $end_occurrence;

    public $import_key;

    /** @var date $actioncomm_datep Value of ActionComm object datep */
    public $actioncomm_datep;
    /** @var date $actioncomm_datef Value of ActionComm object datef */
    public $actioncomm_datef;

    /** @var bool $skip_generate_recurring */
    public $skip_generate_recurring = false;

    /**
     * RecurringEvent constructor.
     * @param DoliDB    $db    Database connector
     */
    public function __construct($db)
    {
        global $conf;

        parent::__construct($db);

        $this->init();

        $this->entity = $conf->entity;
        $this->fk_actioncomm_master = 0;
    }

    /**
     *	Get object and children from database
     *
     *	@param      int			$id       		Id of object to load
     * 	@param		bool		$loadChild		used to load children from database
     *  @param      string      $ref            Ref
     *	@return     int         				>0 if OK, <0 if KO, 0 if not found
     */
    public function fetch($id, $loadChild = true, $ref = null)
    {
        $res = parent::fetch($id, $loadChild, $ref);
        if ($res > 0) $this->oldcopy = dol_clone($this);

        return $res;
    }


    /**
     *	Get object and children from database on custom field
     *
     *	@param      string		$key       		key of object to load
     *	@param      string		$field       	field of object used to load
     * 	@param		bool		$loadChild		used to load children from database
     *	@return     int         				>0 if OK, <0 if KO, 0 if not found
     */
    public function fetchBy($key, $field, $loadChild = true)
    {
        $res = parent::fetchBy($key, $field, $loadChild);
        if ($res > 0) $this->oldcopy = dol_clone($this);

        return $res;
    }

    /**
     * @param 	User 	$user 		User object
	 * @param	bool	$notrigger	false=launch triggers after, true=disable triggers
     * @return int
     */
    public function save($user, $notrigger = false)
    {
        return $this->create($user, $notrigger);
    }

    /**
     * Function to create object in database
     *
     * @param   User    $user   	user object
	 * @param	bool	$notrigger	false=launch triggers after, true=disable triggers
     * @return  int                 < 0 if ko, > 0 if ok
     */
    public function create(User &$user, $notrigger = false)
    {
        if ($this->cleanParams() > 0)
        {
            if($this->id > 0) return parent::create($user, $notrigger);

            $res = parent::create($user, $notrigger);

            if (empty($this->skip_generate_recurring)) $this->generateRecurring();

            return $res;
        }

        return -1;
    }

    /**
     * Function to update object or create or delete if needed
     *
     * @param   User    $user   	user object
	 * @param	bool	$notrigger	false=launch triggers after, true=disable triggers
     * @return  int                 < 0 if ko, > 0 if ok
     */
    public function update(User &$user, $notrigger = false)
    {
        if ($this->cleanParams() > 0)
        {

//            var_dump($this->compareWithOldCopy());exit;

            if ($this->compareWithOldCopy() > 0)
            {
                // Si l'event modifié fait partie d'une chaine en étant esclave, alors il devient maitre et donc indépendant
                if (!empty($this->fk_actioncomm_master)) $this->fk_actioncomm_master = 0;


                $res = parent::update($user, $notrigger);

                // Diff found !
                // TODO delete Actioncomm
                $TChild = $this->getAllChainFromMaster();
                foreach ($TChild as $child)
                {
                    $r = $child->delete($notrigger);
//                    var_dump($r);exit;
                }
//var_dump(count($TChild));
//                exit;
                // TODO generate recurring
                if (empty($this->skip_generate_recurring)) $this->generateRecurring();

                return $res;
            }

            return 0;
        }

        return -1;
    }

    /**
     * @param 	User 	$user 		User object
	 * @param	bool	$notrigger	false=launch triggers after, true=disable triggers
     * @return  int
     */
    public function delete(User &$user, $notrigger = false)
    {
        // TODO passer des param supplémentaire pour s'il ne faut delete que l'objet courant et conserver les events suivant (attention : penser au transfert de master)
        $TChild = $this->getAllChainFromMaster();
        foreach ($TChild as $child)
        {
            // Attention, il s'agit d'un objet ActionComm de Dolibarr, le jour où le paramètre $user sera ajouté, il faudra mettre cette ligne à jour
            $child->delete($notrigger);
        }

        $this->deleteObjectLinked();

        unset($this->fk_element); // avoid conflict with standard Dolibarr comportment
        return parent::delete($user, $notrigger);
    }


    /**
     * @return ActionComm[]
     */
    public function getAllChainFromMaster()
    {
        $TChild = array();

        $sql = 'SELECT fk_actioncomm FROM '.MAIN_DB_PREFIX.$this->table_element.' WHERE fk_actioncomm_master = '.$this->fk_actioncomm;
        $resql = $this->db->query($sql);
        if ($resql)
        {
            while ($obj = $this->db->fetch_object($resql))
            {
                $o = new Actioncomm($this->db);
                $o->fetch($obj->fk_actioncomm);
                $TChild[] = $o;
            }
        }
        else
        {
            $this->error = $this->db->lasterror();
            $this->errors[] = $this->error;
        }

        return $TChild;
    }

    /**
     * @return int 1 if OK, -1 if KO
     */
    public function cleanParams()
    {
        if (empty($this->fk_actioncomm))
        {
            $this->error = 'RecurringEventMissingParameterActioncommId';
            return -1;
        }

        // La répitition sur les jours de la semaine n'est valable que si la fréquence est paramétré sur la semaine
        if ($this->frequency_unit !== 'week') $this->weekday_repeat = array();

        $this->frequency = (int) $this->frequency; // integer, not double

        if ($this->end_type === 'date')
        {
            $this->end_occurrence = 0;
            // TODO check if end_date is correct ?
        }
        else
        {
            $this->end_type = 'occurrence';
            $this->end_occurrence = (int) $this->end_occurrence; // integer, not double
            $this->end_date = 0; // integer, not double
        }

        return 1;
    }

    /**
     * @return int 0 if equal, 1 if difference found
     */
    public function compareWithOldCopy()
    {

        if (!empty($this->fk_actioncomm_master))
        {
            $object = new RecurringEvent($this->db);
            $object->fetchBy($this->fk_actioncomm_master, 'fk_actioncomm');

// TODO à revoir !!!!
            if (
                $this->frequency != $object->frequency
                || $this->frequency_unit != $object->frequency_unit
                || array_diff($this->weekday_repeat, $object->weekday_repeat)
                || $this->end_type != $object->end_type
                || $this->end_date != $object->end_date
                || $this->end_occurrence != $object->end_occurrence
                || $this->actioncomm_datep != $object->actioncomm_datep
                || $this->actioncomm_datef != $object->actioncomm_datef
            )
            {
                return 1;
            }
        }
        else
        {
//            var_dump(
//                [$this->frequency , $this->oldcopy->frequency]
//                , [$this->frequency_unit , $this->oldcopy->frequency_unit]
//                , [array_diff($this->weekday_repeat, $this->oldcopy->weekday_repeat)]
//                , [$this->end_type , $this->oldcopy->end_type]
//                , [$this->end_date , $this->oldcopy->end_date]
//                , [$this->end_occurrence , $this->oldcopy->end_occurrence]
//
//            );
////            var_dump($this->end_date , $this->oldcopy->end_date);
//            exit;

            if (
                $this->frequency != $this->oldcopy->frequency
                || $this->frequency_unit != $this->oldcopy->frequency_unit
                || array_diff($this->weekday_repeat, $this->oldcopy->weekday_repeat)
                || $this->end_type != $this->oldcopy->end_type
                || $this->end_date != $this->oldcopy->end_date
                || $this->end_occurrence != $this->oldcopy->end_occurrence
                || $this->actioncomm_datep != $this->oldcopy->actioncomm_datep
                || $this->actioncomm_datef != $this->oldcopy->actioncomm_datef
            )
            {
                return 1;
            }
        }

        return 0;
    }

    /**
     * TODO Refactor is needed
	 * @param	bool	$notrigger	false=launch triggers after, true=disable triggers
     * @return  int
     */
    private function generateRecurring($notrigger = false)
    {
        global $user;

        $actioncommMaster = new ActionComm($this->db);
        if ($actioncommMaster->fetch($this->fk_actioncomm) > 0)
        {
            $current_date = $actioncommMaster->datep;
	        $delta=0;
	        if (!empty($actioncommMaster->datef)) {
		        $delta = $actioncommMaster->datef - $current_date;
	        }

            if ($this->frequency_unit !== 'week')
            {
                if ($this->end_type === 'date')
                {
                    while ($current_date = strtotime('+'.$this->frequency.' '.$this->frequency_unit, $current_date))
                    {
                        if ($current_date > $this->end_date) break;
                        $this->createRecurring($user, $notrigger, $actioncommMaster, $current_date, $delta);
                    }
                }
                else
                {
                    $end_occurrence = $this->end_occurrence - 1; // -1, car l'event master compte pour 1
                    while ($end_occurrence--)
                    {
                        $current_date = strtotime('+'.$this->frequency.' '.$this->frequency_unit, $current_date);
                        $this->createRecurring($user, $notrigger, $actioncommMaster, $current_date, $delta);
                    }
                }
            }
            else
            {
                if (!in_array(date('w', $current_date), $this->weekday_repeat))
                {
                    // Besoin de modifier la date de début et fin de l'event master
                    while ($current_date = strtotime('+1 day ', $current_date))
                    {
                        $weekday_index = date('w', $current_date);
                        if (in_array($weekday_index, $this->weekday_repeat))
                        {
                            $actioncommMaster->datep = $current_date;
                            if (!empty($delta)) {
	                            $actioncommMaster->datef = $current_date + $delta;
                            }
                            $actioncommMaster->context['recurringevent_skip_trigger_create'] = true;
                            $actioncommMaster->update($user, $notrigger);
                            break;
                        }
                    }
                }


                if ($this->end_type === 'date')
                {
                    while ($current_date = strtotime('+1 day ', $current_date))
                    {
                        if ($current_date > $this->end_date) break;
                        $weekday_index = date('w', $current_date);
                        if (in_array($weekday_index, $this->weekday_repeat))
                        {
                            $this->createRecurring($user, $notrigger, $actioncommMaster, $current_date, $delta);
                        }
                    }
                }
                else
                {
                    $end_occurrence = $this->end_occurrence - 1; // -1, car l'event master compte pour 1
                    while ($end_occurrence)
                    {
                        $current_date = strtotime('+1 day ', $current_date);
                        $weekday_index = date('w', $current_date);
                        if (in_array($weekday_index, $this->weekday_repeat))
                        {
                            $this->createRecurring($user, $notrigger, $actioncommMaster, $current_date, $delta);
                            $end_occurrence--;
                        }
                    }
                }
            }

            return 1;
        }

        return -1;
    }

    /**
     * @param User $user Object
	 * @param bool $notrigger false=launch triggers after, true=disable triggers
     * @param ActionComm $actioncommMaster Object
     * @param int $current_date timestamp
     * @param int $delta event duration in seconds
     * @return void
     */
    private function createRecurring($user, $notrigger, $actioncommMaster, $current_date, $delta)
    {
        /** @var ActionComm $ac */
        $ac = dol_clone($actioncommMaster);
        $ac->db = $this->db; // Reinit database connector
        $ac->id = null;
        $ac->datep = $current_date;
        if (!empty($delta)) {
	        $ac->datef = $current_date + $delta;
        }
        $ac->context['recurringevent_skip_trigger_create'] = true;
        $ac->create($user, $notrigger);

        /** @var RecurringEvent $re */
        $re = dol_clone($this);
        $re->db = $this->db;
        $re->id = null;
        $re->fk_actioncomm = $ac->id;
        $re->fk_actioncomm_master = $actioncommMaster->id;
        $re->skip_generate_recurring = true;
        $re->save($user, $notrigger);
    }
}
