'use strict';

{
<<<<<<< HEAD
    document.querySelector('ul').addEventListener('click', (e) => {
        if (e.target.nodeName === 'LI') {
            e.target.classList.toggle('done');
        }
    });
=======
    class Post {
        constructor(text) {
            this.text = text;
            this.likeCount = 0;
        }

        show() {
            console.log(`${this.text} - ${this.likeCount} likes`);
        }

        like() {
            this.likeCount++;
            this.show();
        }

    }

    class SponsoredPost extends Post {
        constructor(text, sponsor) {
            super(text);
            this.sponsor = sponsor;
        }

        show() {
            super.show();
            // console.log(`${this.text} - ${this.likeCount} likes`);
            console.log(`... sponsored by ${this.sponsor}`);
        }
    }

    const posts = [
        new Post('JavaScriptの勉強中・・・'),
        new Post('プログラミングたのしい'),
        new SponsoredPost('lets master with ..', 'dotinstall'),
    ];

    posts[2].show();
    posts[2].like();
>>>>>>> da8509c9a0970de68896c79259b0aa4a44d09395
}