<?php

namespace App\Enums;

enum TablesEnum : string
{
    case USERS = 'users';
    case ADMINS = 'admins';
    case PASSWORD_RESET_TOKENS = 'password_reset_tokens';
    case ADMIN_PASSWORD_RESET_TOKENS = 'admin_password_reset_tokens';
    case PERSONAL_ACCESS_TOKENS = 'personal_access_tokens';
    case ARTICLES = 'articles';
    case COMMENTS = 'comments';
    case CATEGORIES = 'categories';
    case ARTICLE_LIKE = 'article_like';
    case ARTICLES_PHOTOS = 'article_photos';
    case BLOG_VOTES = 'blog_votes';
}
