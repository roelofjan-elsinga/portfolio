!["Lock on blue wall"](/images/articles/lock-on-blue-wall.jpeg)
# How to set up GPG signing keys with Git in Github

If you've ever used a Github integration, then you'll now you can verify your Git commits. In this post, I'll go over the steps you need to take to accomplish this for your own development system. After you've completed these steps, the commits you've done will have a "Verified" flag in GitHub. 

Before we get into it, it's probably a good idea to explain what the verified tag means. It means that when you commit code, the commit is signed with a key, the GPG key. This key contains information about you, like your name and e-mail address. When you submit your public key in GitHub, GitHub can verify that the signed commit was created by your account. All it means is that anyone with access to the repository can see that the commit was made on your system by somehow who knows the passphrase to unlock your public key. Ideally, this can only be you. It's a way to verify that you were the one creating the commit and no one else.

Now let's get into the steps you need to take to get this GPG key and start getting the "Verified" flag. For this post I'm focusing on how to do this on a Linux distribution, because that's what I use on a daily basis. You can find out how to do this for your preferred platform on the [Github help pages](https://help.github.com/en/github/authenticating-to-github/generating-a-new-gpg-key). 

## Step 1: Check if you have any keys available

You can find out if you already have a GPG key by running the following command:

```bash
gpg --list-secret-keys --keyid-format LONG
```

If you have no keys available, or you want to create a new one, go to step 2. Otherwise you can skip ahead to step 3.

## Step 2: Generate a new GPG key

When generating a new GPG key, you'll need to fill out some personal information. This information will be used by GitHub to verify that it was you who made the commit. To generate a new key, run the following command:

```bash
gpg --full-generate-key
```

It will prompt you for some options. When it asks for which type of key, select the default choice (RSA and RSA). Then it will ask you for the key size, fill in 4096. Then it will ask you when you want this key to expire. I went for 0 (never expire), but you can choose another one if you need to.

Then it will ask for your name and e-mail address, along with a comment. The comment can be used to identify the key. For example, fill in your company name if you're on your company computer. When filling out your e-mail address, make sure it's the same e-mail address you used to sign up for GitHub.

When you go to the next step, you need to fill out a passphrase (or password). Choose one that you can't guess easily. Preferably use a random password generator with 16 or more characters. Be sure to save this passphrase somewhere, because you will need to fill it in when you commit your changes. 

## Step 3: Submit your key to GitHub

When you're here you already had a GPG key or you just created a new one. Let's verify if your system can see your key by running the command from step 1 once again:

```bash
gpg --list-secret-keys --keyid-format LONG
```

If you see your key, you're ready to submit it to GitHub. When running that command you should see a section that starts with "sec" like below:

```
sec   rsa4096/gpgIdentifier 2020-03-18 [SC]
```

Copy the "gpgIdentifier" part of that line (no rsa4096/ attached), because this represents the identifier for your GPG key. I replaced my key in that last line to make clear what you're looking for. We're going to use that identifier to find out what your public GPG key is. This public key is what we'll submit to GitHub. Using the identifier, run the command below:

```bash
gpg --armor --export gpgIdentifier
```

You should now see your public code, starting with "-----BEGIN PGP PUBLIC KEY BLOCK-----" and ending with "-----END PGP PUBLIC KEY BLOCK---—". Copy this entire key, including the lines I mentioned in the last sentence. 

Now that you have this code, go to GitHub → Settings → SSH and GPG Keys. Now you have to scroll to the bottom until you get to the GPG keys section and then press "New GPG key". In the next form, paste your GPG key and save.

## Step 4: Configure Git to use your GPG key to sign commits

You now have generated a GPG key and submitted the public key of this to GitHub. The last thing left to do is tell Git to use your key to sign your commits. You have two options: Do this for a specific repository or do this for all your repositories. Remember the gpgIdentifier from the last step? We need that one last time, so be sure to copy that again.

First, we need to tell Git that we want to sign commits. To only enable signing commits for the current repository, run this command:

```bash
git config commit.gpgsign true
```

To enable signing for all repositories in your system, run:

```bash
git config --global commit.gpgsign true
```

Now that Git know we want to sign commits, we need to specify which GPG key we want to use for this. Again, you can do this for specific repositories or for all repositories on your system. To Tell git to use the GPG key we just created for the current repository, run:

```bash
git config user.signingkey gpgIdentifier
```

If you want to do this for all your repositories, run this command:

```bash
git config --global user.signingkey gpgIdentifier
```

Git now knows that we want to sign commits and which GPG key to use to do this. Now when you commit code, you will need to enter your passphrase, but in order to do this properly, you need to tell your GPG agent how you want to input this passphrase. A simple trick is to add an environment variable to your ~/.bash_profile or ~/.profile by running these two commands:

```bash
test -r ~/.bash_profile && echo 'export GPG_TTY=$(tty)' >> ~/.bash_profile
```

```bash
echo 'export GPG_TTY=$(tty)' >> ~/.profile
```

All that's left to do is write code and commit your changes. When you commit, your system will ask you for a passphrase. This is the passphrase you filled in when generating the GPG key, so fill that in. I'm using Ubuntu and when prompting for my passphrase, they give you an option to save this passphrase so you won't have to fill it in every time you create a commit. You can do this or not do this. It's obviously safer to fill in your passphrase all the time, but it also takes longer. I'll leave it up to you which you prefer.

When you push your changes to GitHub, you will now see that beautiful "Verified" flag on your commits.