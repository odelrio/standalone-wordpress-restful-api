<?php

namespace HyperWP\Infrastructure\Persistence\SQL;

use HyperWP\Domain\Model\Author;
use HyperWP\Domain\Model\AuthorRepository;
use PDO;

class SqlAuthorRepository implements AuthorRepository
{
    private const DEFAULT_CLASS = Author::class;
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

    public function all()
    {
        $stmt = $this->dbh->prepare("
            SELECT
                wp_users.ID as id,
                wp_users.user_nicename as userName,
                wp_users.display_name as displayName,
                wp_users.user_email as email,
                wp_users.user_registered as registeredDate,
                COUNT(wp_posts.ID) AS publishedPostsCount
            FROM wp_users INNER JOIN wp_posts ON wp_users.ID = wp_posts.post_author
            WHERE wp_posts.post_status = 'publish' AND wp_posts.post_type = 'post'
            GROUP BY wp_users.ID
        ");

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::DEFAULT_CLASS);
    }

    public function find(int $id)
    {
        $stmt = $this->dbh->prepare("
            SELECT
                wp_users.ID as id,
                wp_users.user_nicename as userName,
                wp_users.display_name as displayName,
                wp_users.user_email as email,
                wp_users.user_registered as registeredDate,
                COUNT(wp_posts.ID) AS publishedPostsCount
            FROM wp_users INNER JOIN wp_posts ON wp_users.ID = wp_posts.post_author
            WHERE
                wp_users.ID = :id AND
                wp_posts.post_status = 'publish' AND
                wp_posts.post_type = 'post'
            GROUP BY wp_users.ID
        ");

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::DEFAULT_CLASS)[0];
    }

    public function byUserName(string $userName)
    {
        $stmt = $this->dbh->prepare("
            SELECT
                wp_users.ID as id,
                wp_users.user_nicename as userName,
                wp_users.display_name as displayName,
                wp_users.user_email as email,
                wp_users.user_registered as registeredDate,
                COUNT(wp_posts.ID) AS publishedPostsCount
            FROM wp_users INNER JOIN wp_posts ON wp_users.ID = wp_posts.post_author
            WHERE
                wp_users.user_nicename = :userName AND
                wp_posts.post_status = 'publish' AND
                wp_posts.post_type = 'post'
            GROUP BY wp_users.ID
        ");

        $stmt->bindParam(':userName', $userName);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_CLASS, self::DEFAULT_CLASS)[0];
    }
}