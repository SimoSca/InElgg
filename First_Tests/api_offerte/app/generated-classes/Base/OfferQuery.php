<?php

namespace Base;

use \Offer as ChildOffer;
use \OfferQuery as ChildOfferQuery;
use \Exception;
use \PDO;
use Map\OfferTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'offer' table.
 *
 * 
 *
 * @method     ChildOfferQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOfferQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildOfferQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildOfferQuery orderByPublisher($order = Criteria::ASC) Order by the publisher column
 * @method     ChildOfferQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildOfferQuery orderByMinqt($order = Criteria::ASC) Order by the minqt column
 * @method     ChildOfferQuery orderByMaxqt($order = Criteria::ASC) Order by the maxqt column
 * @method     ChildOfferQuery orderByCreated($order = Criteria::ASC) Order by the created column
 * @method     ChildOfferQuery orderByModified($order = Criteria::ASC) Order by the modified column
 *
 * @method     ChildOfferQuery groupById() Group by the id column
 * @method     ChildOfferQuery groupByName() Group by the name column
 * @method     ChildOfferQuery groupByDescription() Group by the description column
 * @method     ChildOfferQuery groupByPublisher() Group by the publisher column
 * @method     ChildOfferQuery groupByPrice() Group by the price column
 * @method     ChildOfferQuery groupByMinqt() Group by the minqt column
 * @method     ChildOfferQuery groupByMaxqt() Group by the maxqt column
 * @method     ChildOfferQuery groupByCreated() Group by the created column
 * @method     ChildOfferQuery groupByModified() Group by the modified column
 *
 * @method     ChildOfferQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOfferQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOfferQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOffer findOne(ConnectionInterface $con = null) Return the first ChildOffer matching the query
 * @method     ChildOffer findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOffer matching the query, or a new ChildOffer object populated from the query conditions when no match is found
 *
 * @method     ChildOffer findOneById(int $id) Return the first ChildOffer filtered by the id column
 * @method     ChildOffer findOneByName(string $name) Return the first ChildOffer filtered by the name column
 * @method     ChildOffer findOneByDescription(string $description) Return the first ChildOffer filtered by the description column
 * @method     ChildOffer findOneByPublisher(int $publisher) Return the first ChildOffer filtered by the publisher column
 * @method     ChildOffer findOneByPrice(double $price) Return the first ChildOffer filtered by the price column
 * @method     ChildOffer findOneByMinqt(double $minqt) Return the first ChildOffer filtered by the minqt column
 * @method     ChildOffer findOneByMaxqt(double $maxqt) Return the first ChildOffer filtered by the maxqt column
 * @method     ChildOffer findOneByCreated(string $created) Return the first ChildOffer filtered by the created column
 * @method     ChildOffer findOneByModified(string $modified) Return the first ChildOffer filtered by the modified column *

 * @method     ChildOffer requirePk($key, ConnectionInterface $con = null) Return the ChildOffer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffer requireOne(ConnectionInterface $con = null) Return the first ChildOffer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOffer requireOneById(int $id) Return the first ChildOffer filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffer requireOneByName(string $name) Return the first ChildOffer filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffer requireOneByDescription(string $description) Return the first ChildOffer filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffer requireOneByPublisher(int $publisher) Return the first ChildOffer filtered by the publisher column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffer requireOneByPrice(double $price) Return the first ChildOffer filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffer requireOneByMinqt(double $minqt) Return the first ChildOffer filtered by the minqt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffer requireOneByMaxqt(double $maxqt) Return the first ChildOffer filtered by the maxqt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffer requireOneByCreated(string $created) Return the first ChildOffer filtered by the created column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOffer requireOneByModified(string $modified) Return the first ChildOffer filtered by the modified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOffer[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOffer objects based on current ModelCriteria
 * @method     ChildOffer[]|ObjectCollection findById(int $id) Return ChildOffer objects filtered by the id column
 * @method     ChildOffer[]|ObjectCollection findByName(string $name) Return ChildOffer objects filtered by the name column
 * @method     ChildOffer[]|ObjectCollection findByDescription(string $description) Return ChildOffer objects filtered by the description column
 * @method     ChildOffer[]|ObjectCollection findByPublisher(int $publisher) Return ChildOffer objects filtered by the publisher column
 * @method     ChildOffer[]|ObjectCollection findByPrice(double $price) Return ChildOffer objects filtered by the price column
 * @method     ChildOffer[]|ObjectCollection findByMinqt(double $minqt) Return ChildOffer objects filtered by the minqt column
 * @method     ChildOffer[]|ObjectCollection findByMaxqt(double $maxqt) Return ChildOffer objects filtered by the maxqt column
 * @method     ChildOffer[]|ObjectCollection findByCreated(string $created) Return ChildOffer objects filtered by the created column
 * @method     ChildOffer[]|ObjectCollection findByModified(string $modified) Return ChildOffer objects filtered by the modified column
 * @method     ChildOffer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OfferQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OfferQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'foowd_api', $modelName = '\\Offer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOfferQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOfferQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOfferQuery) {
            return $criteria;
        }
        $query = new ChildOfferQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildOffer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = OfferTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OfferTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOffer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, description, publisher, price, minqt, maxqt, created, modified FROM offer WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildOffer $obj */
            $obj = new ChildOffer();
            $obj->hydrate($row);
            OfferTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildOffer|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildOfferQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OfferTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOfferQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OfferTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOfferQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(OfferTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OfferTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOfferQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOfferQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OfferTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the publisher column
     *
     * Example usage:
     * <code>
     * $query->filterByPublisher(1234); // WHERE publisher = 1234
     * $query->filterByPublisher(array(12, 34)); // WHERE publisher IN (12, 34)
     * $query->filterByPublisher(array('min' => 12)); // WHERE publisher > 12
     * </code>
     *
     * @param     mixed $publisher The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOfferQuery The current query, for fluid interface
     */
    public function filterByPublisher($publisher = null, $comparison = null)
    {
        if (is_array($publisher)) {
            $useMinMax = false;
            if (isset($publisher['min'])) {
                $this->addUsingAlias(OfferTableMap::COL_PUBLISHER, $publisher['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($publisher['max'])) {
                $this->addUsingAlias(OfferTableMap::COL_PUBLISHER, $publisher['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferTableMap::COL_PUBLISHER, $publisher, $comparison);
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOfferQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(OfferTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(OfferTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferTableMap::COL_PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the minqt column
     *
     * Example usage:
     * <code>
     * $query->filterByMinqt(1234); // WHERE minqt = 1234
     * $query->filterByMinqt(array(12, 34)); // WHERE minqt IN (12, 34)
     * $query->filterByMinqt(array('min' => 12)); // WHERE minqt > 12
     * </code>
     *
     * @param     mixed $minqt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOfferQuery The current query, for fluid interface
     */
    public function filterByMinqt($minqt = null, $comparison = null)
    {
        if (is_array($minqt)) {
            $useMinMax = false;
            if (isset($minqt['min'])) {
                $this->addUsingAlias(OfferTableMap::COL_MINQT, $minqt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($minqt['max'])) {
                $this->addUsingAlias(OfferTableMap::COL_MINQT, $minqt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferTableMap::COL_MINQT, $minqt, $comparison);
    }

    /**
     * Filter the query on the maxqt column
     *
     * Example usage:
     * <code>
     * $query->filterByMaxqt(1234); // WHERE maxqt = 1234
     * $query->filterByMaxqt(array(12, 34)); // WHERE maxqt IN (12, 34)
     * $query->filterByMaxqt(array('min' => 12)); // WHERE maxqt > 12
     * </code>
     *
     * @param     mixed $maxqt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOfferQuery The current query, for fluid interface
     */
    public function filterByMaxqt($maxqt = null, $comparison = null)
    {
        if (is_array($maxqt)) {
            $useMinMax = false;
            if (isset($maxqt['min'])) {
                $this->addUsingAlias(OfferTableMap::COL_MAXQT, $maxqt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($maxqt['max'])) {
                $this->addUsingAlias(OfferTableMap::COL_MAXQT, $maxqt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferTableMap::COL_MAXQT, $maxqt, $comparison);
    }

    /**
     * Filter the query on the created column
     *
     * Example usage:
     * <code>
     * $query->filterByCreated('2011-03-14'); // WHERE created = '2011-03-14'
     * $query->filterByCreated('now'); // WHERE created = '2011-03-14'
     * $query->filterByCreated(array('max' => 'yesterday')); // WHERE created > '2011-03-13'
     * </code>
     *
     * @param     mixed $created The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOfferQuery The current query, for fluid interface
     */
    public function filterByCreated($created = null, $comparison = null)
    {
        if (is_array($created)) {
            $useMinMax = false;
            if (isset($created['min'])) {
                $this->addUsingAlias(OfferTableMap::COL_CREATED, $created['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($created['max'])) {
                $this->addUsingAlias(OfferTableMap::COL_CREATED, $created['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferTableMap::COL_CREATED, $created, $comparison);
    }

    /**
     * Filter the query on the modified column
     *
     * Example usage:
     * <code>
     * $query->filterByModified('2011-03-14'); // WHERE modified = '2011-03-14'
     * $query->filterByModified('now'); // WHERE modified = '2011-03-14'
     * $query->filterByModified(array('max' => 'yesterday')); // WHERE modified > '2011-03-13'
     * </code>
     *
     * @param     mixed $modified The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOfferQuery The current query, for fluid interface
     */
    public function filterByModified($modified = null, $comparison = null)
    {
        if (is_array($modified)) {
            $useMinMax = false;
            if (isset($modified['min'])) {
                $this->addUsingAlias(OfferTableMap::COL_MODIFIED, $modified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($modified['max'])) {
                $this->addUsingAlias(OfferTableMap::COL_MODIFIED, $modified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OfferTableMap::COL_MODIFIED, $modified, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildOffer $offer Object to remove from the list of results
     *
     * @return $this|ChildOfferQuery The current query, for fluid interface
     */
    public function prune($offer = null)
    {
        if ($offer) {
            $this->addUsingAlias(OfferTableMap::COL_ID, $offer->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the offer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OfferTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OfferTableMap::clearInstancePool();
            OfferTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OfferTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OfferTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            OfferTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            OfferTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OfferQuery
