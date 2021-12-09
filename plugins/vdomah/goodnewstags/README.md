# Vdomah.GoodNewsTags plugin for Lovata.GoodNews plugin

Plugin adds ability to create tags and attach them to articles.

## Installation

### Artisan

Using the Laravel’s CLI is the fastest way to get started. Just run the following commands in a project’s root directory:

```bash
php artisan plugin:install vdomah.goodnewstags
```

Or go to your project's Backend Updates section or to plugin's marketplace page and install it.

# Documentation

In backend tags management page added under GoodNews section and tags field in Article form.

##Components

### TagList
Use this component to display tags on the front-end. Only tags with articles are shown.

#### Parameters

- **Sorting**
sort tags by name or by related articles count.

- **TagsLimit**
number of tags to show

- **tagParameterName**
parameter name to store chosen tag value in query string (?**tag**=city)

- **emptyTagRedirectPage**
the page to redirect if tag parameter is empty (?**tag**=)

#### Methods

- **make**
getting all tags collection with related articles.
````
{% set tags = TagList.make() %}
````

- **tagHttpQueryString**
get query string for a tag
````
{% for tag in tags %}
<a href="{{ 'home'|page ~ '?' ~ TagList.tagHttpQueryString(tag) }}">{{ tag.name }} </a>
{% endfor %}
````

- **getArticleIdsByTag**
Get article ids array for chosen tag: when ?**tag**=city is present in the url.

### Example page
````
title = "Home"
url = "/"
layout = "demo"
is_hidden = 0

[ArticleList]
sorting = "publish|desc"

[TagList]
sorting = "articles_count|desc"
tagsLimit = 10
tagParameterName = "tag"
emptyTagRedirectPage = "home"
==
<div class="row">
    <div class="col-9">
        <div class="row">
            {% for article in ArticleList.make(TagList.getArticleIdsByTag()).sort('publish|desc').published() %}
            {% partial 'article' article=article %}
            {% endfor %}
        </div>
    </div>
    <div class="col-3">
        {% partial 'site/sidebar' %}
    </div>
</div>
````