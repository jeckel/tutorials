# Docker PHP image with Composer pre-installed

:arrow_right: [Read full tutorial (in french for now)](http://www.jeckel.fr/2017/12/une-image-docker-php-avec-composer-pre-installe/)

# Requirements

- docker

# How to use it

In a shell command line, build the image:

```bash
$> docker build -t php-composer .
```

Test it:

```bash
$> docker run --rm -u $UID:$GID php-composer composer --version
Composer version 1.5.6 2017-12-18 12:09:18
```
