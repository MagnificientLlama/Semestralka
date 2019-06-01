<?php

namespace Base;

use \Author as ChildAuthor;
use \AuthorQuery as ChildAuthorQuery;
use \Book as ChildBook;
use \BookQuery as ChildBookQuery;
use \Bookinreadinglist as ChildBookinreadinglist;
use \BookinreadinglistQuery as ChildBookinreadinglistQuery;
use \Booktagged as ChildBooktagged;
use \BooktaggedQuery as ChildBooktaggedQuery;
use \Chapter as ChildChapter;
use \ChapterQuery as ChildChapterQuery;
use \Userrating as ChildUserrating;
use \UserratingQuery as ChildUserratingQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\BookTableMap;
use Map\BookinreadinglistTableMap;
use Map\BooktaggedTableMap;
use Map\ChapterTableMap;
use Map\UserratingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'book' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Book implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\BookTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the bookid field.
     *
     * @var        int
     */
    protected $bookid;

    /**
     * The value for the bookname field.
     *
     * @var        string
     */
    protected $bookname;

    /**
     * The value for the yearofrelease field.
     *
     * @var        DateTime
     */
    protected $yearofrelease;

    /**
     * The value for the bookdescription field.
     *
     * @var        string
     */
    protected $bookdescription;

    /**
     * The value for the isbn field.
     *
     * @var        string
     */
    protected $isbn;

    /**
     * The value for the bookimage field.
     *
     * @var        string
     */
    protected $bookimage;

    /**
     * The value for the author_authid1 field.
     *
     * @var        int
     */
    protected $author_authid1;

    /**
     * @var        ChildAuthor
     */
    protected $aAuthor;

    /**
     * @var        ObjectCollection|ChildBookinreadinglist[] Collection to store aggregation of ChildBookinreadinglist objects.
     */
    protected $collBookinreadinglists;
    protected $collBookinreadinglistsPartial;

    /**
     * @var        ObjectCollection|ChildBooktagged[] Collection to store aggregation of ChildBooktagged objects.
     */
    protected $collBooktaggeds;
    protected $collBooktaggedsPartial;

    /**
     * @var        ObjectCollection|ChildChapter[] Collection to store aggregation of ChildChapter objects.
     */
    protected $collChapters;
    protected $collChaptersPartial;

    /**
     * @var        ObjectCollection|ChildUserrating[] Collection to store aggregation of ChildUserrating objects.
     */
    protected $collUserratings;
    protected $collUserratingsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBookinreadinglist[]
     */
    protected $bookinreadinglistsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBooktagged[]
     */
    protected $booktaggedsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildChapter[]
     */
    protected $chaptersScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUserrating[]
     */
    protected $userratingsScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Book object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Book</code> instance.  If
     * <code>obj</code> is an instance of <code>Book</code>, delegates to
     * <code>equals(Book)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Book The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [bookid] column value.
     *
     * @return int
     */
    public function getBookid()
    {
        return $this->bookid;
    }

    /**
     * Get the [bookname] column value.
     *
     * @return string
     */
    public function getBookname()
    {
        return $this->bookname;
    }

    /**
     * Get the [optionally formatted] temporal [yearofrelease] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getYearofrelease($format = NULL)
    {
        if ($format === null) {
            return $this->yearofrelease;
        } else {
            return $this->yearofrelease instanceof \DateTimeInterface ? $this->yearofrelease->format($format) : null;
        }
    }

    /**
     * Get the [bookdescription] column value.
     *
     * @return string
     */
    public function getBookdescription()
    {
        return $this->bookdescription;
    }

    /**
     * Get the [isbn] column value.
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Get the [bookimage] column value.
     *
     * @return string
     */
    public function getBookimage()
    {
        return $this->bookimage;
    }

    /**
     * Get the [author_authid1] column value.
     *
     * @return int
     */
    public function getAuthorAuthid1()
    {
        return $this->author_authid1;
    }

    /**
     * Set the value of [bookid] column.
     *
     * @param int $v new value
     * @return $this|\Book The current object (for fluent API support)
     */
    public function setBookid($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->bookid !== $v) {
            $this->bookid = $v;
            $this->modifiedColumns[BookTableMap::COL_BOOKID] = true;
        }

        return $this;
    } // setBookid()

    /**
     * Set the value of [bookname] column.
     *
     * @param string $v new value
     * @return $this|\Book The current object (for fluent API support)
     */
    public function setBookname($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bookname !== $v) {
            $this->bookname = $v;
            $this->modifiedColumns[BookTableMap::COL_BOOKNAME] = true;
        }

        return $this;
    } // setBookname()

    /**
     * Sets the value of [yearofrelease] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Book The current object (for fluent API support)
     */
    public function setYearofrelease($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->yearofrelease !== null || $dt !== null) {
            if ($this->yearofrelease === null || $dt === null || $dt->format("Y-m-d") !== $this->yearofrelease->format("Y-m-d")) {
                $this->yearofrelease = $dt === null ? null : clone $dt;
                $this->modifiedColumns[BookTableMap::COL_YEAROFRELEASE] = true;
            }
        } // if either are not null

        return $this;
    } // setYearofrelease()

    /**
     * Set the value of [bookdescription] column.
     *
     * @param string $v new value
     * @return $this|\Book The current object (for fluent API support)
     */
    public function setBookdescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bookdescription !== $v) {
            $this->bookdescription = $v;
            $this->modifiedColumns[BookTableMap::COL_BOOKDESCRIPTION] = true;
        }

        return $this;
    } // setBookdescription()

    /**
     * Set the value of [isbn] column.
     *
     * @param string $v new value
     * @return $this|\Book The current object (for fluent API support)
     */
    public function setIsbn($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->isbn !== $v) {
            $this->isbn = $v;
            $this->modifiedColumns[BookTableMap::COL_ISBN] = true;
        }

        return $this;
    } // setIsbn()

    /**
     * Set the value of [bookimage] column.
     *
     * @param string $v new value
     * @return $this|\Book The current object (for fluent API support)
     */
    public function setBookimage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bookimage !== $v) {
            $this->bookimage = $v;
            $this->modifiedColumns[BookTableMap::COL_BOOKIMAGE] = true;
        }

        return $this;
    } // setBookimage()

    /**
     * Set the value of [author_authid1] column.
     *
     * @param int $v new value
     * @return $this|\Book The current object (for fluent API support)
     */
    public function setAuthorAuthid1($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->author_authid1 !== $v) {
            $this->author_authid1 = $v;
            $this->modifiedColumns[BookTableMap::COL_AUTHOR_AUTHID1] = true;
        }

        if ($this->aAuthor !== null && $this->aAuthor->getAuthid() !== $v) {
            $this->aAuthor = null;
        }

        return $this;
    } // setAuthorAuthid1()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BookTableMap::translateFieldName('Bookid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bookid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BookTableMap::translateFieldName('Bookname', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bookname = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BookTableMap::translateFieldName('Yearofrelease', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->yearofrelease = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BookTableMap::translateFieldName('Bookdescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bookdescription = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BookTableMap::translateFieldName('Isbn', TableMap::TYPE_PHPNAME, $indexType)];
            $this->isbn = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BookTableMap::translateFieldName('Bookimage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bookimage = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BookTableMap::translateFieldName('AuthorAuthid1', TableMap::TYPE_PHPNAME, $indexType)];
            $this->author_authid1 = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = BookTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Book'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aAuthor !== null && $this->author_authid1 !== $this->aAuthor->getAuthid()) {
            $this->aAuthor = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBookQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAuthor = null;
            $this->collBookinreadinglists = null;

            $this->collBooktaggeds = null;

            $this->collChapters = null;

            $this->collUserratings = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Book::setDeleted()
     * @see Book::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBookQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                BookTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aAuthor !== null) {
                if ($this->aAuthor->isModified() || $this->aAuthor->isNew()) {
                    $affectedRows += $this->aAuthor->save($con);
                }
                $this->setAuthor($this->aAuthor);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->bookinreadinglistsScheduledForDeletion !== null) {
                if (!$this->bookinreadinglistsScheduledForDeletion->isEmpty()) {
                    \BookinreadinglistQuery::create()
                        ->filterByPrimaryKeys($this->bookinreadinglistsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bookinreadinglistsScheduledForDeletion = null;
                }
            }

            if ($this->collBookinreadinglists !== null) {
                foreach ($this->collBookinreadinglists as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->booktaggedsScheduledForDeletion !== null) {
                if (!$this->booktaggedsScheduledForDeletion->isEmpty()) {
                    \BooktaggedQuery::create()
                        ->filterByPrimaryKeys($this->booktaggedsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->booktaggedsScheduledForDeletion = null;
                }
            }

            if ($this->collBooktaggeds !== null) {
                foreach ($this->collBooktaggeds as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->chaptersScheduledForDeletion !== null) {
                if (!$this->chaptersScheduledForDeletion->isEmpty()) {
                    \ChapterQuery::create()
                        ->filterByPrimaryKeys($this->chaptersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->chaptersScheduledForDeletion = null;
                }
            }

            if ($this->collChapters !== null) {
                foreach ($this->collChapters as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userratingsScheduledForDeletion !== null) {
                if (!$this->userratingsScheduledForDeletion->isEmpty()) {
                    \UserratingQuery::create()
                        ->filterByPrimaryKeys($this->userratingsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->userratingsScheduledForDeletion = null;
                }
            }

            if ($this->collUserratings !== null) {
                foreach ($this->collUserratings as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[BookTableMap::COL_BOOKID] = true;
        if (null !== $this->bookid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BookTableMap::COL_BOOKID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BookTableMap::COL_BOOKID)) {
            $modifiedColumns[':p' . $index++]  = 'bookID';
        }
        if ($this->isColumnModified(BookTableMap::COL_BOOKNAME)) {
            $modifiedColumns[':p' . $index++]  = 'bookName';
        }
        if ($this->isColumnModified(BookTableMap::COL_YEAROFRELEASE)) {
            $modifiedColumns[':p' . $index++]  = 'yearOfRelease';
        }
        if ($this->isColumnModified(BookTableMap::COL_BOOKDESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'bookDescription';
        }
        if ($this->isColumnModified(BookTableMap::COL_ISBN)) {
            $modifiedColumns[':p' . $index++]  = 'ISBN';
        }
        if ($this->isColumnModified(BookTableMap::COL_BOOKIMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'bookImage';
        }
        if ($this->isColumnModified(BookTableMap::COL_AUTHOR_AUTHID1)) {
            $modifiedColumns[':p' . $index++]  = 'author_authID1';
        }

        $sql = sprintf(
            'INSERT INTO book (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'bookID':
                        $stmt->bindValue($identifier, $this->bookid, PDO::PARAM_INT);
                        break;
                    case 'bookName':
                        $stmt->bindValue($identifier, $this->bookname, PDO::PARAM_STR);
                        break;
                    case 'yearOfRelease':
                        $stmt->bindValue($identifier, $this->yearofrelease ? $this->yearofrelease->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'bookDescription':
                        $stmt->bindValue($identifier, $this->bookdescription, PDO::PARAM_STR);
                        break;
                    case 'ISBN':
                        $stmt->bindValue($identifier, $this->isbn, PDO::PARAM_STR);
                        break;
                    case 'bookImage':
                        $stmt->bindValue($identifier, $this->bookimage, PDO::PARAM_STR);
                        break;
                    case 'author_authID1':
                        $stmt->bindValue($identifier, $this->author_authid1, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setBookid($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BookTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getBookid();
                break;
            case 1:
                return $this->getBookname();
                break;
            case 2:
                return $this->getYearofrelease();
                break;
            case 3:
                return $this->getBookdescription();
                break;
            case 4:
                return $this->getIsbn();
                break;
            case 5:
                return $this->getBookimage();
                break;
            case 6:
                return $this->getAuthorAuthid1();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Book'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Book'][$this->hashCode()] = true;
        $keys = BookTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getBookid(),
            $keys[1] => $this->getBookname(),
            $keys[2] => $this->getYearofrelease(),
            $keys[3] => $this->getBookdescription(),
            $keys[4] => $this->getIsbn(),
            $keys[5] => $this->getBookimage(),
            $keys[6] => $this->getAuthorAuthid1(),
        );
        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aAuthor) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'author';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'author';
                        break;
                    default:
                        $key = 'Author';
                }

                $result[$key] = $this->aAuthor->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBookinreadinglists) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'bookinreadinglists';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'bookinreadinglists';
                        break;
                    default:
                        $key = 'Bookinreadinglists';
                }

                $result[$key] = $this->collBookinreadinglists->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBooktaggeds) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'booktaggeds';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'booktaggeds';
                        break;
                    default:
                        $key = 'Booktaggeds';
                }

                $result[$key] = $this->collBooktaggeds->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collChapters) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'chapters';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'chapters';
                        break;
                    default:
                        $key = 'Chapters';
                }

                $result[$key] = $this->collChapters->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserratings) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userratings';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'userratings';
                        break;
                    default:
                        $key = 'Userratings';
                }

                $result[$key] = $this->collUserratings->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Book
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BookTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Book
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setBookid($value);
                break;
            case 1:
                $this->setBookname($value);
                break;
            case 2:
                $this->setYearofrelease($value);
                break;
            case 3:
                $this->setBookdescription($value);
                break;
            case 4:
                $this->setIsbn($value);
                break;
            case 5:
                $this->setBookimage($value);
                break;
            case 6:
                $this->setAuthorAuthid1($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = BookTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setBookid($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setBookname($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setYearofrelease($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setBookdescription($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIsbn($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setBookimage($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setAuthorAuthid1($arr[$keys[6]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Book The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BookTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BookTableMap::COL_BOOKID)) {
            $criteria->add(BookTableMap::COL_BOOKID, $this->bookid);
        }
        if ($this->isColumnModified(BookTableMap::COL_BOOKNAME)) {
            $criteria->add(BookTableMap::COL_BOOKNAME, $this->bookname);
        }
        if ($this->isColumnModified(BookTableMap::COL_YEAROFRELEASE)) {
            $criteria->add(BookTableMap::COL_YEAROFRELEASE, $this->yearofrelease);
        }
        if ($this->isColumnModified(BookTableMap::COL_BOOKDESCRIPTION)) {
            $criteria->add(BookTableMap::COL_BOOKDESCRIPTION, $this->bookdescription);
        }
        if ($this->isColumnModified(BookTableMap::COL_ISBN)) {
            $criteria->add(BookTableMap::COL_ISBN, $this->isbn);
        }
        if ($this->isColumnModified(BookTableMap::COL_BOOKIMAGE)) {
            $criteria->add(BookTableMap::COL_BOOKIMAGE, $this->bookimage);
        }
        if ($this->isColumnModified(BookTableMap::COL_AUTHOR_AUTHID1)) {
            $criteria->add(BookTableMap::COL_AUTHOR_AUTHID1, $this->author_authid1);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildBookQuery::create();
        $criteria->add(BookTableMap::COL_BOOKID, $this->bookid);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getBookid();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getBookid();
    }

    /**
     * Generic method to set the primary key (bookid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setBookid($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getBookid();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Book (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBookname($this->getBookname());
        $copyObj->setYearofrelease($this->getYearofrelease());
        $copyObj->setBookdescription($this->getBookdescription());
        $copyObj->setIsbn($this->getIsbn());
        $copyObj->setBookimage($this->getBookimage());
        $copyObj->setAuthorAuthid1($this->getAuthorAuthid1());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBookinreadinglists() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBookinreadinglist($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBooktaggeds() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBooktagged($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getChapters() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addChapter($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserratings() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserrating($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setBookid(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Book Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildAuthor object.
     *
     * @param  ChildAuthor $v
     * @return $this|\Book The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAuthor(ChildAuthor $v = null)
    {
        if ($v === null) {
            $this->setAuthorAuthid1(NULL);
        } else {
            $this->setAuthorAuthid1($v->getAuthid());
        }

        $this->aAuthor = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildAuthor object, it will not be re-added.
        if ($v !== null) {
            $v->addBook($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildAuthor object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildAuthor The associated ChildAuthor object.
     * @throws PropelException
     */
    public function getAuthor(ConnectionInterface $con = null)
    {
        if ($this->aAuthor === null && ($this->author_authid1 != 0)) {
            $this->aAuthor = ChildAuthorQuery::create()->findPk($this->author_authid1, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAuthor->addBooks($this);
             */
        }

        return $this->aAuthor;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Bookinreadinglist' == $relationName) {
            $this->initBookinreadinglists();
            return;
        }
        if ('Booktagged' == $relationName) {
            $this->initBooktaggeds();
            return;
        }
        if ('Chapter' == $relationName) {
            $this->initChapters();
            return;
        }
        if ('Userrating' == $relationName) {
            $this->initUserratings();
            return;
        }
    }

    /**
     * Clears out the collBookinreadinglists collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBookinreadinglists()
     */
    public function clearBookinreadinglists()
    {
        $this->collBookinreadinglists = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBookinreadinglists collection loaded partially.
     */
    public function resetPartialBookinreadinglists($v = true)
    {
        $this->collBookinreadinglistsPartial = $v;
    }

    /**
     * Initializes the collBookinreadinglists collection.
     *
     * By default this just sets the collBookinreadinglists collection to an empty array (like clearcollBookinreadinglists());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBookinreadinglists($overrideExisting = true)
    {
        if (null !== $this->collBookinreadinglists && !$overrideExisting) {
            return;
        }

        $collectionClassName = BookinreadinglistTableMap::getTableMap()->getCollectionClassName();

        $this->collBookinreadinglists = new $collectionClassName;
        $this->collBookinreadinglists->setModel('\Bookinreadinglist');
    }

    /**
     * Gets an array of ChildBookinreadinglist objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBook is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBookinreadinglist[] List of ChildBookinreadinglist objects
     * @throws PropelException
     */
    public function getBookinreadinglists(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBookinreadinglistsPartial && !$this->isNew();
        if (null === $this->collBookinreadinglists || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBookinreadinglists) {
                // return empty collection
                $this->initBookinreadinglists();
            } else {
                $collBookinreadinglists = ChildBookinreadinglistQuery::create(null, $criteria)
                    ->filterByBook($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBookinreadinglistsPartial && count($collBookinreadinglists)) {
                        $this->initBookinreadinglists(false);

                        foreach ($collBookinreadinglists as $obj) {
                            if (false == $this->collBookinreadinglists->contains($obj)) {
                                $this->collBookinreadinglists->append($obj);
                            }
                        }

                        $this->collBookinreadinglistsPartial = true;
                    }

                    return $collBookinreadinglists;
                }

                if ($partial && $this->collBookinreadinglists) {
                    foreach ($this->collBookinreadinglists as $obj) {
                        if ($obj->isNew()) {
                            $collBookinreadinglists[] = $obj;
                        }
                    }
                }

                $this->collBookinreadinglists = $collBookinreadinglists;
                $this->collBookinreadinglistsPartial = false;
            }
        }

        return $this->collBookinreadinglists;
    }

    /**
     * Sets a collection of ChildBookinreadinglist objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $bookinreadinglists A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBook The current object (for fluent API support)
     */
    public function setBookinreadinglists(Collection $bookinreadinglists, ConnectionInterface $con = null)
    {
        /** @var ChildBookinreadinglist[] $bookinreadinglistsToDelete */
        $bookinreadinglistsToDelete = $this->getBookinreadinglists(new Criteria(), $con)->diff($bookinreadinglists);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->bookinreadinglistsScheduledForDeletion = clone $bookinreadinglistsToDelete;

        foreach ($bookinreadinglistsToDelete as $bookinreadinglistRemoved) {
            $bookinreadinglistRemoved->setBook(null);
        }

        $this->collBookinreadinglists = null;
        foreach ($bookinreadinglists as $bookinreadinglist) {
            $this->addBookinreadinglist($bookinreadinglist);
        }

        $this->collBookinreadinglists = $bookinreadinglists;
        $this->collBookinreadinglistsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Bookinreadinglist objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Bookinreadinglist objects.
     * @throws PropelException
     */
    public function countBookinreadinglists(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBookinreadinglistsPartial && !$this->isNew();
        if (null === $this->collBookinreadinglists || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBookinreadinglists) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBookinreadinglists());
            }

            $query = ChildBookinreadinglistQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBook($this)
                ->count($con);
        }

        return count($this->collBookinreadinglists);
    }

    /**
     * Method called to associate a ChildBookinreadinglist object to this object
     * through the ChildBookinreadinglist foreign key attribute.
     *
     * @param  ChildBookinreadinglist $l ChildBookinreadinglist
     * @return $this|\Book The current object (for fluent API support)
     */
    public function addBookinreadinglist(ChildBookinreadinglist $l)
    {
        if ($this->collBookinreadinglists === null) {
            $this->initBookinreadinglists();
            $this->collBookinreadinglistsPartial = true;
        }

        if (!$this->collBookinreadinglists->contains($l)) {
            $this->doAddBookinreadinglist($l);

            if ($this->bookinreadinglistsScheduledForDeletion and $this->bookinreadinglistsScheduledForDeletion->contains($l)) {
                $this->bookinreadinglistsScheduledForDeletion->remove($this->bookinreadinglistsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBookinreadinglist $bookinreadinglist The ChildBookinreadinglist object to add.
     */
    protected function doAddBookinreadinglist(ChildBookinreadinglist $bookinreadinglist)
    {
        $this->collBookinreadinglists[]= $bookinreadinglist;
        $bookinreadinglist->setBook($this);
    }

    /**
     * @param  ChildBookinreadinglist $bookinreadinglist The ChildBookinreadinglist object to remove.
     * @return $this|ChildBook The current object (for fluent API support)
     */
    public function removeBookinreadinglist(ChildBookinreadinglist $bookinreadinglist)
    {
        if ($this->getBookinreadinglists()->contains($bookinreadinglist)) {
            $pos = $this->collBookinreadinglists->search($bookinreadinglist);
            $this->collBookinreadinglists->remove($pos);
            if (null === $this->bookinreadinglistsScheduledForDeletion) {
                $this->bookinreadinglistsScheduledForDeletion = clone $this->collBookinreadinglists;
                $this->bookinreadinglistsScheduledForDeletion->clear();
            }
            $this->bookinreadinglistsScheduledForDeletion[]= clone $bookinreadinglist;
            $bookinreadinglist->setBook(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Book is new, it will return
     * an empty collection; or if this Book has previously
     * been saved, it will retrieve related Bookinreadinglists from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Book.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBookinreadinglist[] List of ChildBookinreadinglist objects
     */
    public function getBookinreadinglistsJoinReadinglist(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBookinreadinglistQuery::create(null, $criteria);
        $query->joinWith('Readinglist', $joinBehavior);

        return $this->getBookinreadinglists($query, $con);
    }

    /**
     * Clears out the collBooktaggeds collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBooktaggeds()
     */
    public function clearBooktaggeds()
    {
        $this->collBooktaggeds = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBooktaggeds collection loaded partially.
     */
    public function resetPartialBooktaggeds($v = true)
    {
        $this->collBooktaggedsPartial = $v;
    }

    /**
     * Initializes the collBooktaggeds collection.
     *
     * By default this just sets the collBooktaggeds collection to an empty array (like clearcollBooktaggeds());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBooktaggeds($overrideExisting = true)
    {
        if (null !== $this->collBooktaggeds && !$overrideExisting) {
            return;
        }

        $collectionClassName = BooktaggedTableMap::getTableMap()->getCollectionClassName();

        $this->collBooktaggeds = new $collectionClassName;
        $this->collBooktaggeds->setModel('\Booktagged');
    }

    /**
     * Gets an array of ChildBooktagged objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBook is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBooktagged[] List of ChildBooktagged objects
     * @throws PropelException
     */
    public function getBooktaggeds(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBooktaggedsPartial && !$this->isNew();
        if (null === $this->collBooktaggeds || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBooktaggeds) {
                // return empty collection
                $this->initBooktaggeds();
            } else {
                $collBooktaggeds = ChildBooktaggedQuery::create(null, $criteria)
                    ->filterByBook($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBooktaggedsPartial && count($collBooktaggeds)) {
                        $this->initBooktaggeds(false);

                        foreach ($collBooktaggeds as $obj) {
                            if (false == $this->collBooktaggeds->contains($obj)) {
                                $this->collBooktaggeds->append($obj);
                            }
                        }

                        $this->collBooktaggedsPartial = true;
                    }

                    return $collBooktaggeds;
                }

                if ($partial && $this->collBooktaggeds) {
                    foreach ($this->collBooktaggeds as $obj) {
                        if ($obj->isNew()) {
                            $collBooktaggeds[] = $obj;
                        }
                    }
                }

                $this->collBooktaggeds = $collBooktaggeds;
                $this->collBooktaggedsPartial = false;
            }
        }

        return $this->collBooktaggeds;
    }

    /**
     * Sets a collection of ChildBooktagged objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $booktaggeds A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBook The current object (for fluent API support)
     */
    public function setBooktaggeds(Collection $booktaggeds, ConnectionInterface $con = null)
    {
        /** @var ChildBooktagged[] $booktaggedsToDelete */
        $booktaggedsToDelete = $this->getBooktaggeds(new Criteria(), $con)->diff($booktaggeds);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->booktaggedsScheduledForDeletion = clone $booktaggedsToDelete;

        foreach ($booktaggedsToDelete as $booktaggedRemoved) {
            $booktaggedRemoved->setBook(null);
        }

        $this->collBooktaggeds = null;
        foreach ($booktaggeds as $booktagged) {
            $this->addBooktagged($booktagged);
        }

        $this->collBooktaggeds = $booktaggeds;
        $this->collBooktaggedsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Booktagged objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Booktagged objects.
     * @throws PropelException
     */
    public function countBooktaggeds(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBooktaggedsPartial && !$this->isNew();
        if (null === $this->collBooktaggeds || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBooktaggeds) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBooktaggeds());
            }

            $query = ChildBooktaggedQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBook($this)
                ->count($con);
        }

        return count($this->collBooktaggeds);
    }

    /**
     * Method called to associate a ChildBooktagged object to this object
     * through the ChildBooktagged foreign key attribute.
     *
     * @param  ChildBooktagged $l ChildBooktagged
     * @return $this|\Book The current object (for fluent API support)
     */
    public function addBooktagged(ChildBooktagged $l)
    {
        if ($this->collBooktaggeds === null) {
            $this->initBooktaggeds();
            $this->collBooktaggedsPartial = true;
        }

        if (!$this->collBooktaggeds->contains($l)) {
            $this->doAddBooktagged($l);

            if ($this->booktaggedsScheduledForDeletion and $this->booktaggedsScheduledForDeletion->contains($l)) {
                $this->booktaggedsScheduledForDeletion->remove($this->booktaggedsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBooktagged $booktagged The ChildBooktagged object to add.
     */
    protected function doAddBooktagged(ChildBooktagged $booktagged)
    {
        $this->collBooktaggeds[]= $booktagged;
        $booktagged->setBook($this);
    }

    /**
     * @param  ChildBooktagged $booktagged The ChildBooktagged object to remove.
     * @return $this|ChildBook The current object (for fluent API support)
     */
    public function removeBooktagged(ChildBooktagged $booktagged)
    {
        if ($this->getBooktaggeds()->contains($booktagged)) {
            $pos = $this->collBooktaggeds->search($booktagged);
            $this->collBooktaggeds->remove($pos);
            if (null === $this->booktaggedsScheduledForDeletion) {
                $this->booktaggedsScheduledForDeletion = clone $this->collBooktaggeds;
                $this->booktaggedsScheduledForDeletion->clear();
            }
            $this->booktaggedsScheduledForDeletion[]= clone $booktagged;
            $booktagged->setBook(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Book is new, it will return
     * an empty collection; or if this Book has previously
     * been saved, it will retrieve related Booktaggeds from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Book.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBooktagged[] List of ChildBooktagged objects
     */
    public function getBooktaggedsJoinTag(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBooktaggedQuery::create(null, $criteria);
        $query->joinWith('Tag', $joinBehavior);

        return $this->getBooktaggeds($query, $con);
    }

    /**
     * Clears out the collChapters collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addChapters()
     */
    public function clearChapters()
    {
        $this->collChapters = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collChapters collection loaded partially.
     */
    public function resetPartialChapters($v = true)
    {
        $this->collChaptersPartial = $v;
    }

    /**
     * Initializes the collChapters collection.
     *
     * By default this just sets the collChapters collection to an empty array (like clearcollChapters());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initChapters($overrideExisting = true)
    {
        if (null !== $this->collChapters && !$overrideExisting) {
            return;
        }

        $collectionClassName = ChapterTableMap::getTableMap()->getCollectionClassName();

        $this->collChapters = new $collectionClassName;
        $this->collChapters->setModel('\Chapter');
    }

    /**
     * Gets an array of ChildChapter objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBook is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildChapter[] List of ChildChapter objects
     * @throws PropelException
     */
    public function getChapters(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collChaptersPartial && !$this->isNew();
        if (null === $this->collChapters || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collChapters) {
                // return empty collection
                $this->initChapters();
            } else {
                $collChapters = ChildChapterQuery::create(null, $criteria)
                    ->filterByBook($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collChaptersPartial && count($collChapters)) {
                        $this->initChapters(false);

                        foreach ($collChapters as $obj) {
                            if (false == $this->collChapters->contains($obj)) {
                                $this->collChapters->append($obj);
                            }
                        }

                        $this->collChaptersPartial = true;
                    }

                    return $collChapters;
                }

                if ($partial && $this->collChapters) {
                    foreach ($this->collChapters as $obj) {
                        if ($obj->isNew()) {
                            $collChapters[] = $obj;
                        }
                    }
                }

                $this->collChapters = $collChapters;
                $this->collChaptersPartial = false;
            }
        }

        return $this->collChapters;
    }

    /**
     * Sets a collection of ChildChapter objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $chapters A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBook The current object (for fluent API support)
     */
    public function setChapters(Collection $chapters, ConnectionInterface $con = null)
    {
        /** @var ChildChapter[] $chaptersToDelete */
        $chaptersToDelete = $this->getChapters(new Criteria(), $con)->diff($chapters);


        $this->chaptersScheduledForDeletion = $chaptersToDelete;

        foreach ($chaptersToDelete as $chapterRemoved) {
            $chapterRemoved->setBook(null);
        }

        $this->collChapters = null;
        foreach ($chapters as $chapter) {
            $this->addChapter($chapter);
        }

        $this->collChapters = $chapters;
        $this->collChaptersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Chapter objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Chapter objects.
     * @throws PropelException
     */
    public function countChapters(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collChaptersPartial && !$this->isNew();
        if (null === $this->collChapters || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collChapters) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getChapters());
            }

            $query = ChildChapterQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBook($this)
                ->count($con);
        }

        return count($this->collChapters);
    }

    /**
     * Method called to associate a ChildChapter object to this object
     * through the ChildChapter foreign key attribute.
     *
     * @param  ChildChapter $l ChildChapter
     * @return $this|\Book The current object (for fluent API support)
     */
    public function addChapter(ChildChapter $l)
    {
        if ($this->collChapters === null) {
            $this->initChapters();
            $this->collChaptersPartial = true;
        }

        if (!$this->collChapters->contains($l)) {
            $this->doAddChapter($l);

            if ($this->chaptersScheduledForDeletion and $this->chaptersScheduledForDeletion->contains($l)) {
                $this->chaptersScheduledForDeletion->remove($this->chaptersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildChapter $chapter The ChildChapter object to add.
     */
    protected function doAddChapter(ChildChapter $chapter)
    {
        $this->collChapters[]= $chapter;
        $chapter->setBook($this);
    }

    /**
     * @param  ChildChapter $chapter The ChildChapter object to remove.
     * @return $this|ChildBook The current object (for fluent API support)
     */
    public function removeChapter(ChildChapter $chapter)
    {
        if ($this->getChapters()->contains($chapter)) {
            $pos = $this->collChapters->search($chapter);
            $this->collChapters->remove($pos);
            if (null === $this->chaptersScheduledForDeletion) {
                $this->chaptersScheduledForDeletion = clone $this->collChapters;
                $this->chaptersScheduledForDeletion->clear();
            }
            $this->chaptersScheduledForDeletion[]= clone $chapter;
            $chapter->setBook(null);
        }

        return $this;
    }

    /**
     * Clears out the collUserratings collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserratings()
     */
    public function clearUserratings()
    {
        $this->collUserratings = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserratings collection loaded partially.
     */
    public function resetPartialUserratings($v = true)
    {
        $this->collUserratingsPartial = $v;
    }

    /**
     * Initializes the collUserratings collection.
     *
     * By default this just sets the collUserratings collection to an empty array (like clearcollUserratings());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserratings($overrideExisting = true)
    {
        if (null !== $this->collUserratings && !$overrideExisting) {
            return;
        }

        $collectionClassName = UserratingTableMap::getTableMap()->getCollectionClassName();

        $this->collUserratings = new $collectionClassName;
        $this->collUserratings->setModel('\Userrating');
    }

    /**
     * Gets an array of ChildUserrating objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBook is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUserrating[] List of ChildUserrating objects
     * @throws PropelException
     */
    public function getUserratings(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserratingsPartial && !$this->isNew();
        if (null === $this->collUserratings || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUserratings) {
                // return empty collection
                $this->initUserratings();
            } else {
                $collUserratings = ChildUserratingQuery::create(null, $criteria)
                    ->filterByBook($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserratingsPartial && count($collUserratings)) {
                        $this->initUserratings(false);

                        foreach ($collUserratings as $obj) {
                            if (false == $this->collUserratings->contains($obj)) {
                                $this->collUserratings->append($obj);
                            }
                        }

                        $this->collUserratingsPartial = true;
                    }

                    return $collUserratings;
                }

                if ($partial && $this->collUserratings) {
                    foreach ($this->collUserratings as $obj) {
                        if ($obj->isNew()) {
                            $collUserratings[] = $obj;
                        }
                    }
                }

                $this->collUserratings = $collUserratings;
                $this->collUserratingsPartial = false;
            }
        }

        return $this->collUserratings;
    }

    /**
     * Sets a collection of ChildUserrating objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userratings A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBook The current object (for fluent API support)
     */
    public function setUserratings(Collection $userratings, ConnectionInterface $con = null)
    {
        /** @var ChildUserrating[] $userratingsToDelete */
        $userratingsToDelete = $this->getUserratings(new Criteria(), $con)->diff($userratings);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->userratingsScheduledForDeletion = clone $userratingsToDelete;

        foreach ($userratingsToDelete as $userratingRemoved) {
            $userratingRemoved->setBook(null);
        }

        $this->collUserratings = null;
        foreach ($userratings as $userrating) {
            $this->addUserrating($userrating);
        }

        $this->collUserratings = $userratings;
        $this->collUserratingsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Userrating objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Userrating objects.
     * @throws PropelException
     */
    public function countUserratings(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserratingsPartial && !$this->isNew();
        if (null === $this->collUserratings || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserratings) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserratings());
            }

            $query = ChildUserratingQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBook($this)
                ->count($con);
        }

        return count($this->collUserratings);
    }

    /**
     * Method called to associate a ChildUserrating object to this object
     * through the ChildUserrating foreign key attribute.
     *
     * @param  ChildUserrating $l ChildUserrating
     * @return $this|\Book The current object (for fluent API support)
     */
    public function addUserrating(ChildUserrating $l)
    {
        if ($this->collUserratings === null) {
            $this->initUserratings();
            $this->collUserratingsPartial = true;
        }

        if (!$this->collUserratings->contains($l)) {
            $this->doAddUserrating($l);

            if ($this->userratingsScheduledForDeletion and $this->userratingsScheduledForDeletion->contains($l)) {
                $this->userratingsScheduledForDeletion->remove($this->userratingsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUserrating $userrating The ChildUserrating object to add.
     */
    protected function doAddUserrating(ChildUserrating $userrating)
    {
        $this->collUserratings[]= $userrating;
        $userrating->setBook($this);
    }

    /**
     * @param  ChildUserrating $userrating The ChildUserrating object to remove.
     * @return $this|ChildBook The current object (for fluent API support)
     */
    public function removeUserrating(ChildUserrating $userrating)
    {
        if ($this->getUserratings()->contains($userrating)) {
            $pos = $this->collUserratings->search($userrating);
            $this->collUserratings->remove($pos);
            if (null === $this->userratingsScheduledForDeletion) {
                $this->userratingsScheduledForDeletion = clone $this->collUserratings;
                $this->userratingsScheduledForDeletion->clear();
            }
            $this->userratingsScheduledForDeletion[]= clone $userrating;
            $userrating->setBook(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Book is new, it will return
     * an empty collection; or if this Book has previously
     * been saved, it will retrieve related Userratings from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Book.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUserrating[] List of ChildUserrating objects
     */
    public function getUserratingsJoinUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUserratingQuery::create(null, $criteria);
        $query->joinWith('User', $joinBehavior);

        return $this->getUserratings($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aAuthor) {
            $this->aAuthor->removeBook($this);
        }
        $this->bookid = null;
        $this->bookname = null;
        $this->yearofrelease = null;
        $this->bookdescription = null;
        $this->isbn = null;
        $this->bookimage = null;
        $this->author_authid1 = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collBookinreadinglists) {
                foreach ($this->collBookinreadinglists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBooktaggeds) {
                foreach ($this->collBooktaggeds as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collChapters) {
                foreach ($this->collChapters as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserratings) {
                foreach ($this->collUserratings as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBookinreadinglists = null;
        $this->collBooktaggeds = null;
        $this->collChapters = null;
        $this->collUserratings = null;
        $this->aAuthor = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BookTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
