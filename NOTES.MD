You may find that you want to keep the _all field around to use as a catchall full-text field just for specific fields, such as title, overview, summary, and tags. Instead of disabling the _all field completely, disable include_in_all for all fields by default, and enable it only on the fields you choose:
    
    "my_type": {
        "include_in_all": false,
        "properties": {
            "title": {
                "type":           "string",
                "include_in_all": true
            },
            ...
        }
    }
    https://www.elastic.co/guide/en/elasticsearch/guide/current/root-object.html


