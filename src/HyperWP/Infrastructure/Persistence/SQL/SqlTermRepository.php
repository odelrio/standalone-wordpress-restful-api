<?php

namespace HyperWP\Infrastructure\Persistence\SQL;

use HyperWP\Domain\Model\Post;
use HyperWP\Domain\Model\Term;
use HyperWP\Domain\Model\TermRepository;
use PDO;

class SqlTermRepository implements TermRepository
{
    private const DEFAULT_CLASS = Term::class;
    /** @var PDO */
    private $dbh;

    /**
     * SqlAuthorRepository constructor.
     *
     * @param $dbh
     */
    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    public function all(string $type = null)
    {
        $sql = "
            SELECT
                wp_terms.term_id as id,
                wp_term_taxonomy.taxonomy as type,
                wp_terms.name as name,
                wp_term_taxonomy.description as description,
                wp_terms.slug as slug,
                wp_term_taxonomy.parent as parentId
            FROM wp_terms INNER JOIN wp_term_taxonomy ON wp_terms.term_id = wp_term_taxonomy.term_id
        ";

        if ($type) {
            $sql .= "WHERE wp_term_taxonomy.taxonomy LIKE :type";
        }

        $stmt = $this->dbh->prepare($sql);

        if ($type) {
            $stmt->bindParam(':type', $type);
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::DEFAULT_CLASS);
    }

    public function find(int $id)
    {
        $stmt = $this->dbh->prepare("
            SELECT
                wp_terms.term_id as id,
                wp_term_taxonomy.taxonomy as type,
                wp_terms.name as name,
                wp_term_taxonomy.description as description,
                wp_terms.slug as slug,
                wp_term_taxonomy.parent as parentId
            FROM wp_terms INNER JOIN wp_term_taxonomy ON wp_terms.term_id = wp_term_taxonomy.term_id
            WHERE wp_terms.term_id = :id
        ");

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::DEFAULT_CLASS)[0];
    }

    public function ofPost(Post $post, $type = null, $order = null)
    {
        $sql = "
            SELECT
                wp_terms.term_id as id,
                wp_term_taxonomy.taxonomy as type,
                wp_terms.name as name,
                wp_term_taxonomy.description as description,
                wp_terms.slug as slug,
                wp_term_taxonomy.parent as parentId
            FROM
                wp_posts
                INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
                INNER JOIN wp_term_taxonomy ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
                INNER JOIN wp_terms ON wp_terms.term_id = wp_term_taxonomy.term_id
            WHERE wp_posts.ID = :id
        ";

        if ($type) {
            $sql .= "AND wp_term_taxonomy.taxonomy LIKE :type";
        }

        $stmt = $this->dbh->prepare($sql);

        $stmt->bindParam(':id', $post->id);

        if ($type) {
            $stmt->bindParam(':type', $type);
        }

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::DEFAULT_CLASS);
    }
}