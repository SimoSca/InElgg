<?php

namespace Map;

use \Offer;
use \OfferQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'offer' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class OfferTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.OfferTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'foowd_api';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'offer';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Offer';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Offer';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    const COL_ID = 'offer.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'offer.name';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'offer.description';

    /**
     * the column name for the publisher field
     */
    const COL_PUBLISHER = 'offer.publisher';

    /**
     * the column name for the price field
     */
    const COL_PRICE = 'offer.price';

    /**
     * the column name for the minqt field
     */
    const COL_MINQT = 'offer.minqt';

    /**
     * the column name for the maxqt field
     */
    const COL_MAXQT = 'offer.maxqt';

    /**
     * the column name for the created field
     */
    const COL_CREATED = 'offer.created';

    /**
     * the column name for the modified field
     */
    const COL_MODIFIED = 'offer.modified';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Description', 'Publisher', 'Price', 'Minqt', 'Maxqt', 'Created', 'Modified', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'description', 'publisher', 'price', 'minqt', 'maxqt', 'created', 'modified', ),
        self::TYPE_COLNAME       => array(OfferTableMap::COL_ID, OfferTableMap::COL_NAME, OfferTableMap::COL_DESCRIPTION, OfferTableMap::COL_PUBLISHER, OfferTableMap::COL_PRICE, OfferTableMap::COL_MINQT, OfferTableMap::COL_MAXQT, OfferTableMap::COL_CREATED, OfferTableMap::COL_MODIFIED, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'description', 'publisher', 'price', 'minqt', 'maxqt', 'created', 'modified', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Description' => 2, 'Publisher' => 3, 'Price' => 4, 'Minqt' => 5, 'Maxqt' => 6, 'Created' => 7, 'Modified' => 8, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'description' => 2, 'publisher' => 3, 'price' => 4, 'minqt' => 5, 'maxqt' => 6, 'created' => 7, 'modified' => 8, ),
        self::TYPE_COLNAME       => array(OfferTableMap::COL_ID => 0, OfferTableMap::COL_NAME => 1, OfferTableMap::COL_DESCRIPTION => 2, OfferTableMap::COL_PUBLISHER => 3, OfferTableMap::COL_PRICE => 4, OfferTableMap::COL_MINQT => 5, OfferTableMap::COL_MAXQT => 6, OfferTableMap::COL_CREATED => 7, OfferTableMap::COL_MODIFIED => 8, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'description' => 2, 'publisher' => 3, 'price' => 4, 'minqt' => 5, 'maxqt' => 6, 'created' => 7, 'modified' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('offer');
        $this->setPhpName('Offer');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Offer');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 255, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 255, null);
        $this->addColumn('publisher', 'Publisher', 'INTEGER', true, null, null);
        $this->addColumn('price', 'Price', 'DECIMAL', false, null, null);
        $this->addColumn('minqt', 'Minqt', 'DECIMAL', false, null, null);
        $this->addColumn('maxqt', 'Maxqt', 'DECIMAL', false, null, null);
        $this->addColumn('created', 'Created', 'TIMESTAMP', false, null, null);
        $this->addColumn('modified', 'Modified', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'validate' => array('rule1' => array ('column' => 'name','validator' => 'Regex','options' => array ('pattern' => '/.*\\S.*/','match' => true,'message' => 'Devi specificare il Nome',),), 'rule' => array ('column' => 'price','validator' => 'Regex','options' => array ('pattern' => '/^[0-9]+[0-9]?[0-9]?$/','match' => false,'message' => 'Devi immettere un numero con la virgola e due decimali',),), ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }
    
    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? OfferTableMap::CLASS_DEFAULT : OfferTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Offer object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OfferTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OfferTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OfferTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OfferTableMap::OM_CLASS;
            /** @var Offer $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OfferTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();
    
        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = OfferTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OfferTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Offer $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OfferTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(OfferTableMap::COL_ID);
            $criteria->addSelectColumn(OfferTableMap::COL_NAME);
            $criteria->addSelectColumn(OfferTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(OfferTableMap::COL_PUBLISHER);
            $criteria->addSelectColumn(OfferTableMap::COL_PRICE);
            $criteria->addSelectColumn(OfferTableMap::COL_MINQT);
            $criteria->addSelectColumn(OfferTableMap::COL_MAXQT);
            $criteria->addSelectColumn(OfferTableMap::COL_CREATED);
            $criteria->addSelectColumn(OfferTableMap::COL_MODIFIED);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.publisher');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.minqt');
            $criteria->addSelectColumn($alias . '.maxqt');
            $criteria->addSelectColumn($alias . '.created');
            $criteria->addSelectColumn($alias . '.modified');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(OfferTableMap::DATABASE_NAME)->getTable(OfferTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(OfferTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(OfferTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new OfferTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Offer or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Offer object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OfferTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Offer) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OfferTableMap::DATABASE_NAME);
            $criteria->add(OfferTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = OfferQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OfferTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OfferTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the offer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OfferQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Offer or Criteria object.
     *
     * @param mixed               $criteria Criteria or Offer object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OfferTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Offer object
        }

        if ($criteria->containsKey(OfferTableMap::COL_ID) && $criteria->keyContainsValue(OfferTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OfferTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = OfferQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OfferTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
OfferTableMap::buildTableMap();
