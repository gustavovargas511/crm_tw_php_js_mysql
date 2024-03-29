<?php

/**
 * ARticle
 * 
 * A piece of writing for publication
 */
class Article
{
    /**
     * Unique identifier
     * @var integer
     */
    public $id;

    /**
     * The article title
     * @var string
     */
    public $title;

    /** The article content
     * @var string;
     */
    public $content;

    /**
     * Publication Date and time
     * @var datetime
     */
    public $published_at;

    /**
     * Update Date and time
     * @var datetime
     */
    public $updated_at;

    /**
     * Publication image file
     * @var string
     */
    public $image_file;

    /**
     * Array for error, if any
     * @array
     */
    public $errors = [];

    /**
     * Get all the articles
     * 
     * @param object $connection to the database
     * 
     * @return array An assosiative array of al th records
     */
    public static function getAll($connection)
    {
        $sql = "SELECT  id, " .
            "title ," .
            "content, " .
            "published_at " .
            "FROM  articles " .
            "ORDER  BY published_at;";

        $results = $connection->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the total count of articles
     * 
     * @param $connection Connection to database
     * 
     * @return integer Total count of articles
     */
    public static function getTotal($connection)
    {

        $sql = "SELECT COUNT(1) " .
            "FROM articles";

        return $connection->query($sql)->fetchColumn();
    }

    /**
     * Get a page of articles
     * 
     * @param object $connection Connection to the database
     * @param integer $limit Number of rows to return
     * @param integer $offset
     */
    public static function getPage($connection, $limit, $offset)
    {
        $sql =  "SELECT a.*, c.name as category_name " .
            "FROM " .
            "(SELECT  id, " .
            "title ," .
            "content, " .
            "published_at " .
            "FROM  articles " .
            "ORDER  BY published_at " .
            "LIMIT :limit " .
            "OFFSET :offset) as a " .
            "LEFT JOIN article_category ac " .
            "ON a.id = ac.article_id " .
            "LEFT JOIN category c " .
            "ON ac.category_id = c.id";

        $prepared_sql = $connection->prepare($sql);

        $prepared_sql->bindValue(':limit', $limit, PDO::PARAM_INT);
        $prepared_sql->bindValue(':offset', $offset, PDO::PARAM_INT);

        $prepared_sql->execute();

        $result = $prepared_sql->fetchAll(PDO::FETCH_ASSOC);

        $articles = [];

        $previous_id = null;

        foreach ($result as $row) {

            $article_id = $row['id'];

            if ($article_id != $previous_id) {

                $row['category_names'] = [];

                $articles[$article_id] = $row;
            }

            $articles[$article_id]['category_names'][] = $row['category_name'];

            $previous_id = $article_id;
        }

        return $articles;
    }

    /**
     * Get the article record based on the ID
     * 
     * @param object $connection Connection to the database
     * @param integer $id the article ID
     * @param string $columns Optional list of columns for the select statment, defaults to *
     * 
     * @return mixed An object of this class, or null if not found
     */
    public static function getArticleByID($connection, $id, $columns = '*')
    {

        //build statement
        $sql = "SELECT $columns " .
            "FROM articles " .
            "WHERE id = :id";

        //prepare statement
        $prepared_sql = $connection->prepare($sql);

        $prepared_sql->bindValue(':id', $id, PDO::PARAM_INT);

        $prepared_sql->setFetchMode(PDO::FETCH_CLASS, 'Article');

        //Execute
        if ($prepared_sql->execute()) {
            //fetch
            return $prepared_sql->fetch();
        }
    }

    /**
     * Get the article's categories
     */
    public function getCategories($connection)
    {
        $sql = "SELECT c.* " .
            "FROM category c " .
            "JOIN article_category ac " .
            "ON c.id = ac.category_id " .
            "WHERE ac.article_id = :id";

        $prepared_sql = $connection->prepare($sql);

        $prepared_sql->bindValue(':id', $this->id, PDO::PARAM_INT);

        $prepared_sql->execute();

        return $prepared_sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the article record based on the ID along with associated categories, if any
     * 
     * @param object $connection Connection to the database
     * @param integer $id the article ID
     * 
     * @return array The article data with categories
     */
    public static function getWithCategories($connection, $id)
    {
        $sql = "SELECT a.*, c.name category_name " .
            "FROM articles a " .
            "LEFT JOIN article_category ac " .
            "ON a.id = ac.article_id " .
            "LEFT JOIN category c " .
            "ON ac.category_id  = c.id " .
            "WHERE a.id = :id";

        $prepared_sql = $connection->prepare($sql);

        $prepared_sql->bindValue(':id', $id, PDO::PARAM_INT);

        $prepared_sql->execute();

        return $prepared_sql->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Update the article with its current property values
     * 
     * @param object $connection Connection to the database
     * 
     * @return boolean True if the update was successful, false otherwise
     */
    public function update($connection)
    {
        if ($this->validate()) {


            $sql = "UPDATE articles " .
                "SET title = :title, " .
                "content = :content, " .
                "updated_at = :updated_at " .
                "WHERE id = :id";

            $prepared_sql = $connection->prepare($sql);

            $prepared_sql->bindValue(':title', $this->title, PDO::PARAM_STR);
            $prepared_sql->bindValue(':content', $this->content, PDO::PARAM_STR);
            $prepared_sql->bindValue(':updated_at', $this->updated_at, PDO::PARAM_STR);
            $prepared_sql->bindValue(':id', $this->id, PDO::PARAM_INT);

            return $prepared_sql->execute();
        } else {
            return false;
        }
    }

    /**
     * Delete the article with its current property values
     * 
     * @param object $connection Connection to the database
     * 
     * @return boolean True if the delete was successful, false otherwise
     */
    public function delete($connection)
    {
        if ($this->validate()) {

            $sql = "DELETE " .
                "FROM articles " .
                "WHERE id = :id";

            $prepared_sql = $connection->prepare($sql);

            $prepared_sql->bindValue(':id', $this->id, PDO::PARAM_INT);


            return $prepared_sql->execute();
        } else {
            return false;
        }
    }

    /**
     * Create the article with its current property values
     * 
     * @param object $connection Connection to the database
     * 
     * @return boolean True if the insert was successful, false otherwise
     */
    public function create($connection)
    {
        if ($this->validate()) {
            $sql = "INSERT INTO articles (" .
                "title," .
                "content," .
                "published_at)" .
                "VALUES (:title, :content, :published_at);";

            $prepared_sql = $connection->prepare($sql);

            $prepared_sql->bindValue(':title', $this->title, PDO::PARAM_STR);
            $prepared_sql->bindValue(':content', $this->content, PDO::PARAM_STR);
            $prepared_sql->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);

            if ($prepared_sql->execute()) {
                $this->id = $connection->lastInsertId();
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Validate the article properties, putting any validation error message in the $errors property
     * 
     * @return boolean: True if properties are valid, False otherwise 
     */
    protected function validate()
    {

        if ($this->title == '') {
            $this->errors[] = 'Title field is mandatory!';
        }

        if ($this->content == '') {
            $this->errors[] = 'Content field is mandatory!';
        }

        return empty($this->errors);
    }

    /**
     * Update image property
     * 
     * @param object $connection Connection to database
     * @param string $filename The Filename of the image file
     * 
     * @return boolean True if success, False otherwise
     */
    public function setImageFile($connection, $filename)
    {
        $sql = "UPDATE articles " .
            "SET image_file = :image_file " .
            "WHERE id = :id";

        $prepared_sql = $connection->prepare($sql);

        $prepared_sql->bindValue(':image_file', $filename, $filename == null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $prepared_sql->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $prepared_sql->execute();
    }

    /**
     * Set the article categories
     * 
     * @param object $conn Connection to the database
     * @param array $ids Category IDs
     * 
     * @return void
     */
    public function setCategories($connection, $ids)
    {

        if ($ids) {
            $sql = "INSERT IGNORE " .
                "INTO article_category (article_id, category_id) " .
                "VALUES ";

            $values = [];

            foreach ($ids as $id) {
                $values[] = "({$this->id}, ?)";
            }

            $sql .= implode(", ", $values);

            //var_dump($sql);
            //exit;

            $prepared_sql = $connection->prepare($sql);

            foreach ($ids as $key => $id) {
                $prepared_sql->bindValue($key + 1, $id, PDO::PARAM_INT);
            }

            $prepared_sql->execute();
        }

        $sql = "DELETE FROM article_category " .
            "WHERE article_id = {$this->id}";

        if ($ids) {
            $placeholders = array_fill(0, count($ids), '?');

            $sql .= " AND category_id NOT IN (" . implode(", ", $placeholders) . ")";
        }

        //var_dump($sql); exit;

        $prepared_sql = $connection->prepare($sql);

        foreach ($ids as $key => $id) {
            $prepared_sql->bindValue($key + 1, $id, PDO::PARAM_INT);
        }

        $prepared_sql->execute();
    }
}
