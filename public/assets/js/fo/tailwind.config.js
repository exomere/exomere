/* theme */

tailwind.config = {
    theme: {
        fontSize: {
            xs: ['12px', '16px'],
            sm: ['14px', '20px'],
            base: ['16px', '19.5px'],
            lg: ['18px', '21.94px'],
            xl: ['20px', '24.38px'],
            '2xl': ['24px', '29.26px'],
            '3xl': ['28px', '50px'],
            '4xl': ['48px', '58px'],
            '8xl': ['96px', '106px']
        }, extend: {
            fontFamily: {
                'nanum-gothic': ['Nanum Gothic', 'sans-serif'],
                'noto-sans': ['Noto Sans KR', 'sans-serif'],
                roboto: ['Roboto', 'sans-serif'],
                poppins: ['Poppins', 'sans-serif'],
                palanquin: ['Palanquin', 'sans-serif'],
                montserrat: ['Montserrat', 'sans-serif'],
            },

            colors: {
                "slate-gray": "#6D6D6D",
                exomere: 'rgb(207 87 51)',
            },
            boxShadow: {
                '3xl': '0 10px 40px rgba(0, 0, 0, 0.1)'
            },
            screens: {
                "wide": "1440px"
            },
            keyframes: {
                showContent: {
                    to: {
                        transform: 'translateY(0px)', filter: 'blur(0px)', opacity: '1',
                    },
                }, contentOut: {
                    to: {
                        transform: 'translateY(-150px)', filter: 'blur(20px)', opacity: '0',
                    }
                }, scaleUpDown: {
                    to: {
                        transform: 'translateY(-150px)', filter: 'blur(20px)', opacity: '0',
                    }
                },
            },
            animation: {
                showContent: 'showContent .5s 1s ease-in-out 1 forwards',
                contentOut: 'contentOut 1.5s linear 1 forwards!important',
                scaleUpDown: 'scaleUpDown 0.1s 0.1s linear 1 forwards',
            },
        },
    }
}



