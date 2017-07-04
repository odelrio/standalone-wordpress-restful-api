<?php

namespace HyperWP\Infrastructure\Persistence\SQL;

use HyperWP\Domain\Model\Post;
use HyperWP\Domain\Model\PostRepository;
use PDO;

class SqlPostRepository implements PostRepository
{
    private const DEFAULT_CLASS = Post::class;
    /** @var PDO */
    private $dbh;

    /**
     * SqlPostRepository constructor.
     *
     * @param $dbh
     */
    public function __construct(PDO $dbh)
    {
        $this->dbh = $dbh;
    }

    public function all(string $status = 'publish')
    {
        $stmt = $this->dbh->prepare("
            SELECT
                ID as id,
                guid as guid,
                post_parent as parentId,
                post_author as authorId,
                post_name as name,
                post_type as type,
                post_mime_type as mimeType,
                post_status as status,
                post_date as dateLocal,
                post_date_gmt as dateGMT,
                post_modified as modifiedDateLocal,
                post_modified_gmt as modifiedDateGMT,
                post_title as title,
                post_content as content,
                post_excerpt as excerpt,
                comment_status as commentStatus,
                comment_count as commentCount,
                ping_status as pingStatus,
                to_ping as toPing,
                pinged,
                post_content_filtered as contentFiltered,
                menu_order as menuOrder,
                length(post_password) > 0 as isPasswordProtected
            FROM wp_posts
            WHERE post_status = :status AND post_type = 'post'
            ORDER BY post_date DESC
        ");

        $stmt->bindParam(':status', $status);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::DEFAULT_CLASS);
    }

    public function find(int $id)
    {
        $stmt = $this->dbh->prepare("
            SELECT
                ID as id,
                guid as guid,
                post_parent as parentId,
                post_author as authorId,
                post_name as name,
                post_type as type,
                post_mime_type as mimeType,
                post_status as status,
                post_date as dateLocal,
                post_date_gmt as dateGMT,
                post_modified as modifiedDateLocal,
                post_modified_gmt as modifiedDateGMT,
                post_title as title,
                post_content as content,
                post_excerpt as excerpt,
                comment_status as commentStatus,
                comment_count as commentCount,
                ping_status as pingStatus,
                to_ping as toPing,
                pinged,
                post_content_filtered as contentFiltered,
                menu_order as menuOrder,
                length(post_password) > 0 as isPasswordProtected
            FROM wp_posts
            WHERE ID = :id AND post_type = 'post'
        ");

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, self::DEFAULT_CLASS)[0];
    }

    public function byDate(\DateTime $dateTime)
    {
        // TODO: Implement byDate() method.
    }

    public function byDateRange(\DatePeriod $datePeriod)
    {
        // TODO: Implement byDateRange() method.
    }
}