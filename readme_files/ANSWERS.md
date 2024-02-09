[< Back to Table of Contents](../README.md)

___

## Task #1

> You need to develop a system for logging various events from the webplatform. The intensity of events is ~500 per second.
> Describe how you would organize:
>
> - The process of collecting of events
> - Events transmission to storage
> - Events storage
> - Events analytics

### Answer

Let's assume we have multiple instances of servers running the same application from which we want to collect logs.
I would solve this task using the Logstash + Elasticsearch stack.


Logs can be output from the application either to files or to a TCP port. Logstash can handle both.
Then, logs can be redirected from Logstash to Elasticsearch, where they will be stored.

By splitting the Elasticsearch index by days, everything is set up.
Elasticsearch makes it very convenient to conduct log analytics if configured correctly.

From the application side, we can use the Monolog library for PHP. It allows configuring parameters corresponding to the input to Logstash.

After that, logs can be written with context, adding various objects characteristic to the application.

This scheme allows us to write logs from all parts of a high-load project to one centralized location without blocking the application.

## Task #3

> You are faced with the task of storing huge count of photos of cars.
> Your project grows, and at some moment you have 1.000.000 cars in your data storage.
> Each car can have from 5 to 20 photos. These photos may be of different resolutions and quality.
> Describe the following technical solutions to potential problems:
> - Where to store this amount of data?
> - How to ensure automatic creation of the thumbnails of each photo and the storage for them?
> - Describe possible caching options.
> - Keep in mind that photos may have strict sorting

### Answer

#### Where to Store

We can store photos on a dedicated server with a fast hard disk (NFS) if the load and traffic are not really high.
Alternatively, we can use a cloud service like AWS (S3) or a CDN if there is a requirement to maintain stable file availability at high speed.

Let's consider method #1 with a custom storage on nginx:

- First, we need to configure the nginx server to serve static files (images, js, css, and other media)
- If necessary, we can shard the hard disks to store different images on different partitions, based, for example, on the file name.
  This way, we can reduce the performance overhead on the hard disk

#### If there are many requests

- We can also enable caching on the HTTP client (using `Cache-Control` directives) if there are many identical requests from one client
- Additionally, we can disable logging of static file requests in nginx to reduce the load on the hard disk of the nginx-server (depends on the architecture) 

#### Automatic Thumbnail Generation

This can be conveniently solved with the nginx `image_filter` module. We can configure it to respond to keywords in the URL.
For example:
  - `/crop/900x900/example_image.png` for cropping the image to a square
  - `/resize/120x120/example_image.png` for resizing to fit the bigger side
  - and so on

#### Modern Browsers

We can also configure nginx to convert images "on the fly". So it can give responses with modern formats like webM or webP to browsers that support them.
This way, the traffic for transporting media will be used even more efficiently

#### Application

All that remains from the application is a table with correspondence between entity content and paths to images.
So then we can load the necessary images by the product key.

___

[< Back to Table of Contents](../README.md)
