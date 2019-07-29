!["Start sprint race"](/images/articles/start-sprint-race.jpeg)

# Improve query performance for polymorphic relationships in Laravel

This post is for developers who make use of polymorphic relationships in Laravel and have noticed 
some performance issues. This post assumes you’re using MySQL or PostgreSQL. If you’re still reading this, 
it means you are in this situation and because of that, I won’t delay you any longer.

## Composite indexes
The query performance has a lot to do with columns being marked as indexes. The primary key, usually the id field, 
is most likely marked as an index, this means that you can very quickly query a database table for a record 
with the matching id. However, when you’re not using indexes on fields you’re interested in, the database has 
to compute your query and look at all records in a table to figure out if it matches your query or not. 
If you’re using an index on the requested field, the database already knows exactly what you want and can 
return the requested records very quickly.

This is what we’ll do for the polymorphic relationships. If your database tables don’t have 100.000 records 
or more, this won’t really benefit you too much. Your query will be very quick, but you won’t notice too 
much of a difference. In my case, the table in question had over 4 million records, so it really took me 
by surprise that the query was slow, because 4 million isn’t such a large number that the query should be slow. 
This is when I noticed the *_type and *_id columns weren’t marked as an index. 

So why a composite index? Well in order to query for the related model, you need both the *_type and *_id column. 
Together, these two columns form a single relationship, which is why we’re going to create a single index for 
the combination of the two columns.

## Laravel migrations
Now that you understand what we’re doing, let’s get to the code.

First, make a new migration through make:migration. Below I’ll give you the specific migration configuration 
I used to create indexes on the activity_log table. In this case, the indexes for the 
polymorphic relationships on the spatie/activitylog package weren't included out-of-the-box. 
I've since made a Pull Request to the GitHub repository and this has been approved. 
So any future users of the package won't have the same problem. 

```php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndexesOnActivityLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->index(['subject_id', 'subject_type'], 'subject');
            $table->index(['causer_id', 'causer_type'], 'causer');
        });
    }
		
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_log', function (Blueprint $table) {
            $table->dropIndex('subject');
            $table->dropIndex('causer');
        });
    }
}
```

When looking at the up() method, you can see that the first argument passed to $this->index() is an array. 
This means that I’m creating an index called subject which contains a combination of subject_id and subject_type. 
The index called causer contains a combination of causer_id and causer_type. After you’ve migrated this migration, 
you should have very quick queries again.

I hope you found this post useful, it certainly helped me solve some querying problems.