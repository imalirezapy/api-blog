<?php

namespace Modules\Core\Enums;

enum ResponseMessageKeys: string
{
    /**
     * Success message keys
     */
        /* Auth & Users */
    case SUCCESS_REGISTERED              = "SUCCESS_REGISTERED";
    case SUCCESS_LOGGEDIN                = "SUCCESS_LOGGEDIN";
    case SUCCESS_LOGGEDOUT               = "SUCCESS_LOGGEDOUT";

        /* Blog */
    case SUCCESS_ARTICLE_CREATED         = "SUCCESS_ARTICLE_CREATED";
    case SUCCESS_ARTICLE_UPDATED         = "SUCCESS_ARTICLE_UPDATED";
    case SUCCESS_ARTICLE_DELETED         = "SUCCESS_ARTICLE_DELETED";
    case SUCCESS_ARTICLE_PUBLISHED       = "SUCCESS_ARTICLE_PUBLISHED";
    case SUCCESS_ARTICLE_DRAFTED         = "SUCCESS_ARTICLE_DRAFTED";
    case SUCCESS_ARTICLE_ARCHIVED        = "SUCCESS_ARTICLE_ARCHIVED";
    case SUCCESS_ARTICLE_PROPOSED        = "SUCCESS_ARTICLE_PROPOSED";

        /* Category */
    case SUCCESS_CATEGORY_UPDATED        = "SUCCESS_CATEGORY_UPDATED";
    case SUCCESS_CATEGORY_DELETED        = "SUCCESS_CATEGORY_DELETED";
    case SUCCESS_CATEGORY_CREATED        = "SUCCESS_CATEGORY_CREATED";

        /* Comments */
    case SUCCESS_COMMENT_CREATED         = "SUCCESS_COMMENT_CREATED";
    case SUCCESS_COMMENT_UPDATED         = "SUCCESS_COMMENT_UPDATED";
    case SUCCESS_COMMENT_DELETED         = "SUCCESS_COMMENT_DELETED";
    case SUCCESS_COMMENT_APPROVED        = "SUCCESS_COMMENT_APPROVED";
    case SUCCESS_COMMENT_REJECTED        = "SUCCESS_COMMENT_REJECTED";
    case SUCCESS_COMMENT_PENDED          = "SUCCESS_COMMENT_PENDED";

    /**
     * Error message keys
     */
        /* Auth & Users */
    case ERROR_404_USER                  = "ERROR_404_USER";

        /* Blog */
    case ERROR_404_ARTICLE               = "ERROR_404_ARTICLE";
    case ERROR_ARTICLE_ALREADY_PUBLISHED = "ERROR_ARTICLE_ALREADY_PUBLISHED";
    case ERROR_ARTICLE_ALREADY_DRAFTED   = "ERROR_ARTICLE_ALREADY_DRAFTED";
    case ERROR_ARTICLE_ALREADY_ARCHIVED  = "ERROR_ARTICLE_ALREADY_ARCHIVED";
    case ERROR_ARTICLE_ALREADY_PROPOSED  = "ERROR_ARTICLE_ALREADY_PROPOSED";

        /* Comments */
    case ERROR_COMMENT_ALREADY_APPROVED  = "ERROR_COMMENT_ALREADY_APPROVED";
    case ERROR_COMMENT_ALREADY_REJECTED  = "ERROR_COMMENT_ALREADY_REJECTED";
    case ERROR_COMMENT_ALREADY_PENDING   = "ERROR_COMMENT_ALREADY_PENDING";

        /* Category */
    case ERROR_404_CATEGORY              = "ERROR_404_CATEGORY";

        /* General errors*/
    case ERROR_UNKNOWN                   = "ERR0R_UNKNOWN";
    case ERROR_500                       = "ERROR_500";
    case ERROR_UNAUTHORIZED              = "ERROR_UNAUTHORIZED";
}
