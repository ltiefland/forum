<?php

/**
 * Policy class for managing access control for the Comment model.
 */

namespace App\Policies;

use /**
 * Class Comment
 *
 * Represents a comment in the application.
 *
 * This class interacts with the 'comments' table in the MySQL database.
 * It is used to manage and retrieve comment data associated with various
 * resources in the application.
 *
 * The model inherits all default functionality and traits from
 * Laravel's Eloquent ORM.
 */
    App\Models\Comment;
use /**
 * Class User
 *
 * Represents the User model in the Laravel application.
 * This model interacts with the users table in the MySQL database.
 *
 * Features:
 * - Handles user data and related operations.
 * - Can include relationships, scopes, and database interactions.
 *
 * Properties and methods related to the user are defined within this class.
 *
 * This model is a part of the Laravel application's namespace App\Models.
 */
    App\Models\User;

/**
 *
 */
class CommentPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {
        if ($user->id !== $comment->user_id) {
            return false;
        }

        return $comment->created_at->isAfter(now()->subHour());
    }
}
