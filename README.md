# [Disqus Conditional Load](https://wordpress.org/plugins/disqus-conditional-load) - for WordPress

Disqus commenting system for WordPress with advanced features like like <strong>lazy load, shortcode</strong> etc.

<hr/>

##### Contributors: <a href="https://github.com/joel-james/">Joel James</a>

##### Requires at least: WordPress 5.0

##### Tested up to: WordPress 6.2

##### Stable tag: 11.1.0

Before starting development make sure you read and understand everything in this README.

Also, don't forget to document your code properly.

## Working with Git

Clone the plugin repo and checkout the `dev` branch

```
# git clone git@github.com:Joel-James/disqus-conditional-load.git
# git fetch && git checkout dev
```

## Installing dependencies and initial configuration

Install Node

```
# curl -sL https://deb.nodesource.com/setup_10.x | sudo -E bash -
# sudo apt-get install -y nodejs build-essential
```

Install the necessary npm modules and packages

```
# npm install
```

After that for the first time, run below command to create updated assets.

```
# npm run compile
```

Set up username and email for Git commits

```
# git config user.email "<your email>"
# git config user.name "<your name>"
```

## Build tasks (npm)

Everything (except unit tests) should be handled by npm. Note that you don't need to interact with Grunt in a direct way.

| Command             | Action                                               |
| ------------------- | ---------------------------------------------------- |
| `npm run translate` | Build pot and mo file inside /languages/ folder      |
| `npm run compile`   | Compile and then generates assets (js & css)         |
| `npm run build`     | Build release version, useful to provide for testing |

## Versioning

Follow semantic versioning [http://semver.org/](http://semver.org/) as `package.json` won't work otherwise. That's it:

-   `X.X.0` for mayor versions
-   `X.X.X` for minor versions
-   `X.X[.X||.0]-rc.1` for release candidates
-   `X.X[.X||.0]-beta.1` for betas

## Workflow

Do not commit on `master` branch (if you are on a forked repo, no need to worry). `dev` is the code
that accumulates all the code for the next version.

-   Create a new branch from `dev` branch: `git checkout -b branch-name origin/dev`. Try to give it a descriptive name. For example:
    -   `release/X.X.X` for next releases
    -   `new/some-feature` for new features
    -   `enhance/some-enhancement` for enhancements
    -   `fix/some-bug` for bug fixing
-   Make your commits and push the new branch: `git push -u origin branch-name`
-   File the new Pull Request against `dev` branch
-   Once the PR is approved it will be merged to the `dev` branch.

If you are sending pull requests from your forked repo, follow the same steps.

## Important Links and Documentation

-   <a href="https://dclwp.com/"><strong>Plugin Website</strong></a>
-   <a href="https://wordpress.org/plugins/disqus-conditional-load/"><strong>WordPress Page</strong></a>
-   <a href="https://wordpress.org/support/plugin/disqus-conditional-load/"><strong>Plugin Support Forum</strong></a>
-   <a href="https://dclwp.com/docs/"><strong>Documentation</strong></a>
