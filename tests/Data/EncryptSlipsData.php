<?php

namespace Tests\Data;

class EncryptSlipsData
{
    public static function getData()
    {
        return [
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3089300,"tjistri":308930,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":79,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":271858,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3381300,"bpjs":74991,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA0srayhisWCgrPQdxnGcPHf24q99yOxXcoK7BGZFwWBwYuThPzlg1
                NYdRuhg7hMQ9EvDcOHLTniU2g7lPfEBDsRkX/HP1uuzsF2KWYpy9tOXI9OECCHwU
                lu2bD1+5omjOdO61Ugg6Ftse3eyk0QJp0bpxefaA7PBzmYwhkxVYIR7fLFQemtLu
                KIrw/9TidZNEnWuN42/WfFrm8eQ6p0U3B+suug5/jV0VD+Aped/l0nsuKU/H7f2A
                7mRq+tDFSxarBvgDzUNWUJ02bTwdNp2QMMf6y0L+Afs5gcLA6rxjOBm0hO7t5IJA
                FW/ycDxIDOqGhT8M1azluz2f48Eai+bL2QIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":89,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3698900,"bpjs":74425,"bpjs2":148850}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAt+ofitI6wOK4z/WA0csV+wnbDlP9O4LvcY0PnLV4kKDi8PyOeohB
                vAvI8U+4Q4ha/08x0pqCdWFp25JSNWOt8MRG5KgshOVDcWYeqe5GzNfFkMdQVNEn
                pe3hoHxne6BQJbZGfavS63TV4Cja1M/NqgdEAmN3HfKzMJk3C7y8RTcqBfY/MoNL
                pTaLMfdCWciw1JUZn5I1lfNfjekJiSFhhlQGSTEPnpFukrOPZjFHLr4QKrVCzqR+
                JZBVFyqCDJFEjmuTjieSn0zAr5D2+p3prLy/mfZ2jnjo5iKrdoyisOY3Mc40EpVP
                ES7Od6N481lzLH0LFX06rx4MuBJKaG5RFwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3186600,"tjistri":318660,"tjanak":63732,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":10,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":285519,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3613100,"bpjs":72643,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAvSXf5LO86hVpbAG6yMm7RMt1CyQcv7FfqhznyzaF6wbsmq9Nfi6Z
                HgcwHR6PF0xV4aFJWeRDrXjzezyi49SbpJlfRE4xqZp58gG+OhTRfOxWma+1hhbe
                gKescD4Ky53Qir3KykffI92j2yUQxEKBjRMvSBX7DgySag08JiK6StPPKFR+7ash
                +mOYSppwrQHEdNvi6Ox+1ieRuKyR44UEgF+Dq5Txs9g4jxV8ZCsrQ6nLv7dQDlo9
                HZ6e8L7l7Fxmht8DUZHGK1UWeYgUXrpxUXT3LGm3FqdlOrzK58qOJ7Z/VMdtnkNf
                rKBGwIw+ihHsn8RIMlTT0Axe2aVzNR8ZMQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":256420,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":225649,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2854800,"bpjs":65110,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAl7aWV12N0/pjuuKRzNDKFdL2kl4Jmd42fbtLBu25jY4egmtWW4p/
                bm1YC7E6tmU4UV6MViAafY4kz3NsEljY7HZdulkGGQEqXlLoI5EqrhEg7jRSiAQq
                Pj5Cige4Io/FCxVUj1rN0LHvXeIihFPz6NZQVITdPTjGj+lJfSQxr/Jjn6hM+2W9
                To+EAEpiE8QEjOP9WKEm2H0aSSreq90mpgWpMUFSmgFjr/PLkDXBEXpxNTJnRyjH
                Uk3Cse37ZiR7ioKmUiNZ12hGMpYOu6TYuqaAtr8psqAUbu2ONbh7WpMpJnd/w2dO
                fOuIawvof86lF3qQghKzM4atonkgeB6EZwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAw6GzSZd7l7lHIugUGvjmODjzAqAMA2zgHVNhP949UU0RCWeHvTuk
                pjhPljUUFz+JGfou8behUianj3XgVjZkLiQ+QkJMTBf/AFnSwPftykwo6NHW822X
                cy98qHQ1w9p2vh4KGoyim/BPunWWnhuNb+TwdHyVDcEK/LACNIMTnNBwnmpA2/+1
                MRsoWvo1FWXqKc3E9Ck0A9EfMEEMOnqei/uDFYVgVVDblwmpCNaw2n2E0eoY6j0Z
                RejtP0fae2TzXlTgn/c32fF0dmsmOize2hJ5U5DvoP/HrEOJBgynRbItdcUm+cNp
                yAy6amc3IeOExOuhOBGWtG1Kg6J7ruIUSwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAo2gbZIzevqBN7DIXOMg8OdAZ2avV4gjWy+Ru15LECTlT7QXnAVfy
                aTwpLNjaQgJi3H6W30Y1CwQdy5tna3YmuBy7zsEGsSfxI9859gg+pzSzvmmmqCTu
                wCx5Rm0HPATdzsxZ/dT53wL2SRs/tbPj0nNfHeK5G+05nEe4nnQUjUp2CpMLxN7M
                mvpb3jFoFnV3hZnhjAM+dHz3IUFY83uZ6tCmTt9hKHmQexMjEveSnKGfRZ8g73M5
                qWp0+rMz6y8vmuVFDSdmW/0v5fiTZoNEb/B3YYJmr2MDT4IQH1WT13JU4M8gn4J+
                F55QMiZOHy7jRiZQMQ0vpIWYct327sK+EwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":39,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3847700,"bpjs":74425,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1R2HaeQ2K6+gi7Hu61LxelpW7hDcFhYah7wN6/96hqMIq6liZtOY
                MjpfNzZpQvcH8RUVOKVVQ6CpCUSalrNlneoQVhVCOOMsY4wsrlCaNhfqDnAUy+Pq
                g3GPKW02/hz38Mb7IZ1pNgD2P1doldJi4LhhnTongArDuKk3yTXX+2N7dHuqYqoU
                2wdjCHQlWwfkZd21pXI91sC8d1NU6gX1G9KK+27e8aQfXErTKO/kNQjablTtN+S2
                TNnoC4Uddsy+o9PH/8ll0ENiRfZCcRF9lIRjuib0LV2omHCspQl0JfGApDLRn8+u
                E9E+DMjS+W3XUSuG8x4b7CxX0QBA6PNVzwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3252900,"tjistri":325290,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":286255,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3552900,"bpjs":68974,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAyBOP6DAAckHg3JDN+Rwjo+Qnlh4zmSWDYU+Xxb8xy3wBWHrV3yow
                naNfXypvNIUSe+MyQ/9wvWDORazubb5QTaW4i6HWRSIzD6Qtfd8bJL9uxk7Gpz99
                thkM9i30h9lCGJod1wJ8I6VuZq72J9pAA464OKy0Iq3LOGOGpfw5INchfL3DR9q6
                SxhngvYP1s34pqToDQzy5XBAsxdzKUOtTDpRmEdDVrThFV2qJg0wdjoLir0mKkt6
                KeUt/+wIM6QZTa2Rvrlbw8WjUxJ7MNVD4YgWPLEBDyU6oeTA4Yru/nZNLJzc1Gug
                looNMhmqI+eGk4i3rLNZ5XrL0jJYiCDKlQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":4671600,"tjistri":467160,"tjanak":186864,"tjupns":0,"tjstruk":0,"tjfungs":960000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":289680,"tjpph":32876,"potpfkbul":0,"potpfk2":0,"potpfk10":426049,"potpph":32876,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":6040500,"bpjs":108807,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAngip29O1zxRnoxxL7lFToAl4KVsmTQZVOWXm+oDkOv7TvEu3Kl0W
                TO/bpp0IjNPV/7NpwBt7FYKTD6NDDGZA2o0w5ykg0hEm9PLM27GcTcqjtVgG93d+
                5DaCm8Gz9O7I/r3LSZTFtls3XpHrpfucHYVNxTQPFsKEkQ9aa67ySdXYJ9IpMK7O
                GatVwwrjCqM6bVDn3R8RFld9pHEsP68jyxLf+sO3lHuUOVNmfiWw8543WtymzRhQ
                Lgsz4nkHsrH9HGNF4HLbpbNdOr73W4z+xPPcAKCun80M8tHlxdhTlTt1NCuL3V9v
                bFqVB8ki/J2/LoGnm3dFpxnwL8JHwDp3lQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":65740,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":83,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":294515,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3715500,"bpjs":73768,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAlG1bOcktswGMm3OMbAQ8vQE5s+SbFKzFfuydQZgDqjv6qaasOShJ
                z/HccJVQRu0nCJkoFcJg2xp49leOJn/OAjk/9nKHrWu5NIq75jz7N+AKTBs/GQUm
                kRVRvxwDrqHoSUknb7kZ4TFFd7v75BAzXhGVY3jHLacZcfkVEHQ+JrTPpZEinQ+q
                hDNqaFJTs2G4QANug6Xv4K0lxjlyzNd9cp+HudCvjpavKYmhfK6QpqgAqAQ+O/nt
                OLFpIEK9zznnIMG2bhC7JYVrcyz8hNG0A+iUl/3BlkCnecFcOauG6eSUJiNTd69M
                zyPOUuzMOtKqg6Rg7/VSHGpqWahLLa9+NwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3426000,"tjistri":342600,"tjanak":68520,"tjupns":0,"tjstruk":0,"tjfungs":1100000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":306969,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":4747300,"bpjs":100163,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1bfVPoaKosUdFhyMzi9fyU/mGHZaO3Sfh8U/XVMy8JZJsc5NRH4C
                uoHodMteSNWpvGQGAk3bmQj+82OpmKRuks30JUy5DrqhyLR1x1p3LuK64JzFAP/7
                7M9xYz6Saxm5/KkS18GibKzp2Ekp2drD9oF74yBakSs6T6UgmvKeDfgIisSh2j6r
                2TtVMmKYXeVOWjrLIigJ8y9lpgrBu3SxZWVi/cvd0G9RjPk+EGnlhJdzLkoZuUrP
                1gLg/zyqySEskJRRSZdWvpJ5anW8GYB85KiJmsqhU5jYQ86sbVPhYESMeCF+WcxX
                4zDwDUxTwvqERp2opDmRfCg6HO0f9xBM5wIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3089300,"tjistri":308930,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":79,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":271858,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3381300,"bpjs":74991,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA0srayhisWCgrPQdxnGcPHf24q99yOxXcoK7BGZFwWBwYuThPzlg1
                NYdRuhg7hMQ9EvDcOHLTniU2g7lPfEBDsRkX/HP1uuzsF2KWYpy9tOXI9OECCHwU
                lu2bD1+5omjOdO61Ugg6Ftse3eyk0QJp0bpxefaA7PBzmYwhkxVYIR7fLFQemtLu
                KIrw/9TidZNEnWuN42/WfFrm8eQ6p0U3B+suug5/jV0VD+Aped/l0nsuKU/H7f2A
                7mRq+tDFSxarBvgDzUNWUJ02bTwdNp2QMMf6y0L+Afs5gcLA6rxjOBm0hO7t5IJA
                FW/ycDxIDOqGhT8M1azluz2f48Eai+bL2QIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":89,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3698900,"bpjs":74425,"bpjs2":148850}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAt+ofitI6wOK4z/WA0csV+wnbDlP9O4LvcY0PnLV4kKDi8PyOeohB
                vAvI8U+4Q4ha/08x0pqCdWFp25JSNWOt8MRG5KgshOVDcWYeqe5GzNfFkMdQVNEn
                pe3hoHxne6BQJbZGfavS63TV4Cja1M/NqgdEAmN3HfKzMJk3C7y8RTcqBfY/MoNL
                pTaLMfdCWciw1JUZn5I1lfNfjekJiSFhhlQGSTEPnpFukrOPZjFHLr4QKrVCzqR+
                JZBVFyqCDJFEjmuTjieSn0zAr5D2+p3prLy/mfZ2jnjo5iKrdoyisOY3Mc40EpVP
                ES7Od6N481lzLH0LFX06rx4MuBJKaG5RFwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3186600,"tjistri":318660,"tjanak":63732,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":10,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":285519,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3613100,"bpjs":72643,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAvSXf5LO86hVpbAG6yMm7RMt1CyQcv7FfqhznyzaF6wbsmq9Nfi6Z
                HgcwHR6PF0xV4aFJWeRDrXjzezyi49SbpJlfRE4xqZp58gG+OhTRfOxWma+1hhbe
                gKescD4Ky53Qir3KykffI92j2yUQxEKBjRMvSBX7DgySag08JiK6StPPKFR+7ash
                +mOYSppwrQHEdNvi6Ox+1ieRuKyR44UEgF+Dq5Txs9g4jxV8ZCsrQ6nLv7dQDlo9
                HZ6e8L7l7Fxmht8DUZHGK1UWeYgUXrpxUXT3LGm3FqdlOrzK58qOJ7Z/VMdtnkNf
                rKBGwIw+ihHsn8RIMlTT0Axe2aVzNR8ZMQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":256420,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":225649,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2854800,"bpjs":65110,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAl7aWV12N0/pjuuKRzNDKFdL2kl4Jmd42fbtLBu25jY4egmtWW4p/
                bm1YC7E6tmU4UV6MViAafY4kz3NsEljY7HZdulkGGQEqXlLoI5EqrhEg7jRSiAQq
                Pj5Cige4Io/FCxVUj1rN0LHvXeIihFPz6NZQVITdPTjGj+lJfSQxr/Jjn6hM+2W9
                To+EAEpiE8QEjOP9WKEm2H0aSSreq90mpgWpMUFSmgFjr/PLkDXBEXpxNTJnRyjH
                Uk3Cse37ZiR7ioKmUiNZ12hGMpYOu6TYuqaAtr8psqAUbu2ONbh7WpMpJnd/w2dO
                fOuIawvof86lF3qQghKzM4atonkgeB6EZwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAw6GzSZd7l7lHIugUGvjmODjzAqAMA2zgHVNhP949UU0RCWeHvTuk
                pjhPljUUFz+JGfou8behUianj3XgVjZkLiQ+QkJMTBf/AFnSwPftykwo6NHW822X
                cy98qHQ1w9p2vh4KGoyim/BPunWWnhuNb+TwdHyVDcEK/LACNIMTnNBwnmpA2/+1
                MRsoWvo1FWXqKc3E9Ck0A9EfMEEMOnqei/uDFYVgVVDblwmpCNaw2n2E0eoY6j0Z
                RejtP0fae2TzXlTgn/c32fF0dmsmOize2hJ5U5DvoP/HrEOJBgynRbItdcUm+cNp
                yAy6amc3IeOExOuhOBGWtG1Kg6J7ruIUSwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAo2gbZIzevqBN7DIXOMg8OdAZ2avV4gjWy+Ru15LECTlT7QXnAVfy
                aTwpLNjaQgJi3H6W30Y1CwQdy5tna3YmuBy7zsEGsSfxI9859gg+pzSzvmmmqCTu
                wCx5Rm0HPATdzsxZ/dT53wL2SRs/tbPj0nNfHeK5G+05nEe4nnQUjUp2CpMLxN7M
                mvpb3jFoFnV3hZnhjAM+dHz3IUFY83uZ6tCmTt9hKHmQexMjEveSnKGfRZ8g73M5
                qWp0+rMz6y8vmuVFDSdmW/0v5fiTZoNEb/B3YYJmr2MDT4IQH1WT13JU4M8gn4J+
                F55QMiZOHy7jRiZQMQ0vpIWYct327sK+EwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":39,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3847700,"bpjs":74425,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1R2HaeQ2K6+gi7Hu61LxelpW7hDcFhYah7wN6/96hqMIq6liZtOY
                MjpfNzZpQvcH8RUVOKVVQ6CpCUSalrNlneoQVhVCOOMsY4wsrlCaNhfqDnAUy+Pq
                g3GPKW02/hz38Mb7IZ1pNgD2P1doldJi4LhhnTongArDuKk3yTXX+2N7dHuqYqoU
                2wdjCHQlWwfkZd21pXI91sC8d1NU6gX1G9KK+27e8aQfXErTKO/kNQjablTtN+S2
                TNnoC4Uddsy+o9PH/8ll0ENiRfZCcRF9lIRjuib0LV2omHCspQl0JfGApDLRn8+u
                E9E+DMjS+W3XUSuG8x4b7CxX0QBA6PNVzwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3252900,"tjistri":325290,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":286255,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3552900,"bpjs":68974,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAyBOP6DAAckHg3JDN+Rwjo+Qnlh4zmSWDYU+Xxb8xy3wBWHrV3yow
                naNfXypvNIUSe+MyQ/9wvWDORazubb5QTaW4i6HWRSIzD6Qtfd8bJL9uxk7Gpz99
                thkM9i30h9lCGJod1wJ8I6VuZq72J9pAA464OKy0Iq3LOGOGpfw5INchfL3DR9q6
                SxhngvYP1s34pqToDQzy5XBAsxdzKUOtTDpRmEdDVrThFV2qJg0wdjoLir0mKkt6
                KeUt/+wIM6QZTa2Rvrlbw8WjUxJ7MNVD4YgWPLEBDyU6oeTA4Yru/nZNLJzc1Gug
                looNMhmqI+eGk4i3rLNZ5XrL0jJYiCDKlQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":4671600,"tjistri":467160,"tjanak":186864,"tjupns":0,"tjstruk":0,"tjfungs":960000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":289680,"tjpph":32876,"potpfkbul":0,"potpfk2":0,"potpfk10":426049,"potpph":32876,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":6040500,"bpjs":108807,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAngip29O1zxRnoxxL7lFToAl4KVsmTQZVOWXm+oDkOv7TvEu3Kl0W
                TO/bpp0IjNPV/7NpwBt7FYKTD6NDDGZA2o0w5ykg0hEm9PLM27GcTcqjtVgG93d+
                5DaCm8Gz9O7I/r3LSZTFtls3XpHrpfucHYVNxTQPFsKEkQ9aa67ySdXYJ9IpMK7O
                GatVwwrjCqM6bVDn3R8RFld9pHEsP68jyxLf+sO3lHuUOVNmfiWw8543WtymzRhQ
                Lgsz4nkHsrH9HGNF4HLbpbNdOr73W4z+xPPcAKCun80M8tHlxdhTlTt1NCuL3V9v
                bFqVB8ki/J2/LoGnm3dFpxnwL8JHwDp3lQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":65740,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":83,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":294515,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3715500,"bpjs":73768,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAlG1bOcktswGMm3OMbAQ8vQE5s+SbFKzFfuydQZgDqjv6qaasOShJ
                z/HccJVQRu0nCJkoFcJg2xp49leOJn/OAjk/9nKHrWu5NIq75jz7N+AKTBs/GQUm
                kRVRvxwDrqHoSUknb7kZ4TFFd7v75BAzXhGVY3jHLacZcfkVEHQ+JrTPpZEinQ+q
                hDNqaFJTs2G4QANug6Xv4K0lxjlyzNd9cp+HudCvjpavKYmhfK6QpqgAqAQ+O/nt
                OLFpIEK9zznnIMG2bhC7JYVrcyz8hNG0A+iUl/3BlkCnecFcOauG6eSUJiNTd69M
                zyPOUuzMOtKqg6Rg7/VSHGpqWahLLa9+NwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3426000,"tjistri":342600,"tjanak":68520,"tjupns":0,"tjstruk":0,"tjfungs":1100000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":306969,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":4747300,"bpjs":100163,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1bfVPoaKosUdFhyMzi9fyU/mGHZaO3Sfh8U/XVMy8JZJsc5NRH4C
                uoHodMteSNWpvGQGAk3bmQj+82OpmKRuks30JUy5DrqhyLR1x1p3LuK64JzFAP/7
                7M9xYz6Saxm5/KkS18GibKzp2Ekp2drD9oF74yBakSs6T6UgmvKeDfgIisSh2j6r
                2TtVMmKYXeVOWjrLIigJ8y9lpgrBu3SxZWVi/cvd0G9RjPk+EGnlhJdzLkoZuUrP
                1gLg/zyqySEskJRRSZdWvpJ5anW8GYB85KiJmsqhU5jYQ86sbVPhYESMeCF+WcxX
                4zDwDUxTwvqERp2opDmRfCg6HO0f9xBM5wIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3089300,"tjistri":308930,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":79,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":271858,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3381300,"bpjs":74991,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA0srayhisWCgrPQdxnGcPHf24q99yOxXcoK7BGZFwWBwYuThPzlg1
                NYdRuhg7hMQ9EvDcOHLTniU2g7lPfEBDsRkX/HP1uuzsF2KWYpy9tOXI9OECCHwU
                lu2bD1+5omjOdO61Ugg6Ftse3eyk0QJp0bpxefaA7PBzmYwhkxVYIR7fLFQemtLu
                KIrw/9TidZNEnWuN42/WfFrm8eQ6p0U3B+suug5/jV0VD+Aped/l0nsuKU/H7f2A
                7mRq+tDFSxarBvgDzUNWUJ02bTwdNp2QMMf6y0L+Afs5gcLA6rxjOBm0hO7t5IJA
                FW/ycDxIDOqGhT8M1azluz2f48Eai+bL2QIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":89,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3698900,"bpjs":74425,"bpjs2":148850}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAt+ofitI6wOK4z/WA0csV+wnbDlP9O4LvcY0PnLV4kKDi8PyOeohB
                vAvI8U+4Q4ha/08x0pqCdWFp25JSNWOt8MRG5KgshOVDcWYeqe5GzNfFkMdQVNEn
                pe3hoHxne6BQJbZGfavS63TV4Cja1M/NqgdEAmN3HfKzMJk3C7y8RTcqBfY/MoNL
                pTaLMfdCWciw1JUZn5I1lfNfjekJiSFhhlQGSTEPnpFukrOPZjFHLr4QKrVCzqR+
                JZBVFyqCDJFEjmuTjieSn0zAr5D2+p3prLy/mfZ2jnjo5iKrdoyisOY3Mc40EpVP
                ES7Od6N481lzLH0LFX06rx4MuBJKaG5RFwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3186600,"tjistri":318660,"tjanak":63732,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":10,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":285519,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3613100,"bpjs":72643,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAvSXf5LO86hVpbAG6yMm7RMt1CyQcv7FfqhznyzaF6wbsmq9Nfi6Z
                HgcwHR6PF0xV4aFJWeRDrXjzezyi49SbpJlfRE4xqZp58gG+OhTRfOxWma+1hhbe
                gKescD4Ky53Qir3KykffI92j2yUQxEKBjRMvSBX7DgySag08JiK6StPPKFR+7ash
                +mOYSppwrQHEdNvi6Ox+1ieRuKyR44UEgF+Dq5Txs9g4jxV8ZCsrQ6nLv7dQDlo9
                HZ6e8L7l7Fxmht8DUZHGK1UWeYgUXrpxUXT3LGm3FqdlOrzK58qOJ7Z/VMdtnkNf
                rKBGwIw+ihHsn8RIMlTT0Axe2aVzNR8ZMQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":256420,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":225649,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2854800,"bpjs":65110,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAl7aWV12N0/pjuuKRzNDKFdL2kl4Jmd42fbtLBu25jY4egmtWW4p/
                bm1YC7E6tmU4UV6MViAafY4kz3NsEljY7HZdulkGGQEqXlLoI5EqrhEg7jRSiAQq
                Pj5Cige4Io/FCxVUj1rN0LHvXeIihFPz6NZQVITdPTjGj+lJfSQxr/Jjn6hM+2W9
                To+EAEpiE8QEjOP9WKEm2H0aSSreq90mpgWpMUFSmgFjr/PLkDXBEXpxNTJnRyjH
                Uk3Cse37ZiR7ioKmUiNZ12hGMpYOu6TYuqaAtr8psqAUbu2ONbh7WpMpJnd/w2dO
                fOuIawvof86lF3qQghKzM4atonkgeB6EZwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAw6GzSZd7l7lHIugUGvjmODjzAqAMA2zgHVNhP949UU0RCWeHvTuk
                pjhPljUUFz+JGfou8behUianj3XgVjZkLiQ+QkJMTBf/AFnSwPftykwo6NHW822X
                cy98qHQ1w9p2vh4KGoyim/BPunWWnhuNb+TwdHyVDcEK/LACNIMTnNBwnmpA2/+1
                MRsoWvo1FWXqKc3E9Ck0A9EfMEEMOnqei/uDFYVgVVDblwmpCNaw2n2E0eoY6j0Z
                RejtP0fae2TzXlTgn/c32fF0dmsmOize2hJ5U5DvoP/HrEOJBgynRbItdcUm+cNp
                yAy6amc3IeOExOuhOBGWtG1Kg6J7ruIUSwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAo2gbZIzevqBN7DIXOMg8OdAZ2avV4gjWy+Ru15LECTlT7QXnAVfy
                aTwpLNjaQgJi3H6W30Y1CwQdy5tna3YmuBy7zsEGsSfxI9859gg+pzSzvmmmqCTu
                wCx5Rm0HPATdzsxZ/dT53wL2SRs/tbPj0nNfHeK5G+05nEe4nnQUjUp2CpMLxN7M
                mvpb3jFoFnV3hZnhjAM+dHz3IUFY83uZ6tCmTt9hKHmQexMjEveSnKGfRZ8g73M5
                qWp0+rMz6y8vmuVFDSdmW/0v5fiTZoNEb/B3YYJmr2MDT4IQH1WT13JU4M8gn4J+
                F55QMiZOHy7jRiZQMQ0vpIWYct327sK+EwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":39,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3847700,"bpjs":74425,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1R2HaeQ2K6+gi7Hu61LxelpW7hDcFhYah7wN6/96hqMIq6liZtOY
                MjpfNzZpQvcH8RUVOKVVQ6CpCUSalrNlneoQVhVCOOMsY4wsrlCaNhfqDnAUy+Pq
                g3GPKW02/hz38Mb7IZ1pNgD2P1doldJi4LhhnTongArDuKk3yTXX+2N7dHuqYqoU
                2wdjCHQlWwfkZd21pXI91sC8d1NU6gX1G9KK+27e8aQfXErTKO/kNQjablTtN+S2
                TNnoC4Uddsy+o9PH/8ll0ENiRfZCcRF9lIRjuib0LV2omHCspQl0JfGApDLRn8+u
                E9E+DMjS+W3XUSuG8x4b7CxX0QBA6PNVzwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3252900,"tjistri":325290,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":286255,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3552900,"bpjs":68974,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAyBOP6DAAckHg3JDN+Rwjo+Qnlh4zmSWDYU+Xxb8xy3wBWHrV3yow
                naNfXypvNIUSe+MyQ/9wvWDORazubb5QTaW4i6HWRSIzD6Qtfd8bJL9uxk7Gpz99
                thkM9i30h9lCGJod1wJ8I6VuZq72J9pAA464OKy0Iq3LOGOGpfw5INchfL3DR9q6
                SxhngvYP1s34pqToDQzy5XBAsxdzKUOtTDpRmEdDVrThFV2qJg0wdjoLir0mKkt6
                KeUt/+wIM6QZTa2Rvrlbw8WjUxJ7MNVD4YgWPLEBDyU6oeTA4Yru/nZNLJzc1Gug
                looNMhmqI+eGk4i3rLNZ5XrL0jJYiCDKlQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":4671600,"tjistri":467160,"tjanak":186864,"tjupns":0,"tjstruk":0,"tjfungs":960000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":289680,"tjpph":32876,"potpfkbul":0,"potpfk2":0,"potpfk10":426049,"potpph":32876,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":6040500,"bpjs":108807,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAngip29O1zxRnoxxL7lFToAl4KVsmTQZVOWXm+oDkOv7TvEu3Kl0W
                TO/bpp0IjNPV/7NpwBt7FYKTD6NDDGZA2o0w5ykg0hEm9PLM27GcTcqjtVgG93d+
                5DaCm8Gz9O7I/r3LSZTFtls3XpHrpfucHYVNxTQPFsKEkQ9aa67ySdXYJ9IpMK7O
                GatVwwrjCqM6bVDn3R8RFld9pHEsP68jyxLf+sO3lHuUOVNmfiWw8543WtymzRhQ
                Lgsz4nkHsrH9HGNF4HLbpbNdOr73W4z+xPPcAKCun80M8tHlxdhTlTt1NCuL3V9v
                bFqVB8ki/J2/LoGnm3dFpxnwL8JHwDp3lQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":65740,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":83,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":294515,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3715500,"bpjs":73768,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAlG1bOcktswGMm3OMbAQ8vQE5s+SbFKzFfuydQZgDqjv6qaasOShJ
                z/HccJVQRu0nCJkoFcJg2xp49leOJn/OAjk/9nKHrWu5NIq75jz7N+AKTBs/GQUm
                kRVRvxwDrqHoSUknb7kZ4TFFd7v75BAzXhGVY3jHLacZcfkVEHQ+JrTPpZEinQ+q
                hDNqaFJTs2G4QANug6Xv4K0lxjlyzNd9cp+HudCvjpavKYmhfK6QpqgAqAQ+O/nt
                OLFpIEK9zznnIMG2bhC7JYVrcyz8hNG0A+iUl/3BlkCnecFcOauG6eSUJiNTd69M
                zyPOUuzMOtKqg6Rg7/VSHGpqWahLLa9+NwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3426000,"tjistri":342600,"tjanak":68520,"tjupns":0,"tjstruk":0,"tjfungs":1100000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":306969,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":4747300,"bpjs":100163,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1bfVPoaKosUdFhyMzi9fyU/mGHZaO3Sfh8U/XVMy8JZJsc5NRH4C
                uoHodMteSNWpvGQGAk3bmQj+82OpmKRuks30JUy5DrqhyLR1x1p3LuK64JzFAP/7
                7M9xYz6Saxm5/KkS18GibKzp2Ekp2drD9oF74yBakSs6T6UgmvKeDfgIisSh2j6r
                2TtVMmKYXeVOWjrLIigJ8y9lpgrBu3SxZWVi/cvd0G9RjPk+EGnlhJdzLkoZuUrP
                1gLg/zyqySEskJRRSZdWvpJ5anW8GYB85KiJmsqhU5jYQ86sbVPhYESMeCF+WcxX
                4zDwDUxTwvqERp2opDmRfCg6HO0f9xBM5wIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3089300,"tjistri":308930,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":79,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":271858,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3381300,"bpjs":74991,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA0srayhisWCgrPQdxnGcPHf24q99yOxXcoK7BGZFwWBwYuThPzlg1
                NYdRuhg7hMQ9EvDcOHLTniU2g7lPfEBDsRkX/HP1uuzsF2KWYpy9tOXI9OECCHwU
                lu2bD1+5omjOdO61Ugg6Ftse3eyk0QJp0bpxefaA7PBzmYwhkxVYIR7fLFQemtLu
                KIrw/9TidZNEnWuN42/WfFrm8eQ6p0U3B+suug5/jV0VD+Aped/l0nsuKU/H7f2A
                7mRq+tDFSxarBvgDzUNWUJ02bTwdNp2QMMf6y0L+Afs5gcLA6rxjOBm0hO7t5IJA
                FW/ycDxIDOqGhT8M1azluz2f48Eai+bL2QIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":89,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3698900,"bpjs":74425,"bpjs2":148850}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAt+ofitI6wOK4z/WA0csV+wnbDlP9O4LvcY0PnLV4kKDi8PyOeohB
                vAvI8U+4Q4ha/08x0pqCdWFp25JSNWOt8MRG5KgshOVDcWYeqe5GzNfFkMdQVNEn
                pe3hoHxne6BQJbZGfavS63TV4Cja1M/NqgdEAmN3HfKzMJk3C7y8RTcqBfY/MoNL
                pTaLMfdCWciw1JUZn5I1lfNfjekJiSFhhlQGSTEPnpFukrOPZjFHLr4QKrVCzqR+
                JZBVFyqCDJFEjmuTjieSn0zAr5D2+p3prLy/mfZ2jnjo5iKrdoyisOY3Mc40EpVP
                ES7Od6N481lzLH0LFX06rx4MuBJKaG5RFwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3186600,"tjistri":318660,"tjanak":63732,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":10,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":285519,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3613100,"bpjs":72643,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAvSXf5LO86hVpbAG6yMm7RMt1CyQcv7FfqhznyzaF6wbsmq9Nfi6Z
                HgcwHR6PF0xV4aFJWeRDrXjzezyi49SbpJlfRE4xqZp58gG+OhTRfOxWma+1hhbe
                gKescD4Ky53Qir3KykffI92j2yUQxEKBjRMvSBX7DgySag08JiK6StPPKFR+7ash
                +mOYSppwrQHEdNvi6Ox+1ieRuKyR44UEgF+Dq5Txs9g4jxV8ZCsrQ6nLv7dQDlo9
                HZ6e8L7l7Fxmht8DUZHGK1UWeYgUXrpxUXT3LGm3FqdlOrzK58qOJ7Z/VMdtnkNf
                rKBGwIw+ihHsn8RIMlTT0Axe2aVzNR8ZMQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":256420,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":225649,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2854800,"bpjs":65110,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAl7aWV12N0/pjuuKRzNDKFdL2kl4Jmd42fbtLBu25jY4egmtWW4p/
                bm1YC7E6tmU4UV6MViAafY4kz3NsEljY7HZdulkGGQEqXlLoI5EqrhEg7jRSiAQq
                Pj5Cige4Io/FCxVUj1rN0LHvXeIihFPz6NZQVITdPTjGj+lJfSQxr/Jjn6hM+2W9
                To+EAEpiE8QEjOP9WKEm2H0aSSreq90mpgWpMUFSmgFjr/PLkDXBEXpxNTJnRyjH
                Uk3Cse37ZiR7ioKmUiNZ12hGMpYOu6TYuqaAtr8psqAUbu2ONbh7WpMpJnd/w2dO
                fOuIawvof86lF3qQghKzM4atonkgeB6EZwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAw6GzSZd7l7lHIugUGvjmODjzAqAMA2zgHVNhP949UU0RCWeHvTuk
                pjhPljUUFz+JGfou8behUianj3XgVjZkLiQ+QkJMTBf/AFnSwPftykwo6NHW822X
                cy98qHQ1w9p2vh4KGoyim/BPunWWnhuNb+TwdHyVDcEK/LACNIMTnNBwnmpA2/+1
                MRsoWvo1FWXqKc3E9Ck0A9EfMEEMOnqei/uDFYVgVVDblwmpCNaw2n2E0eoY6j0Z
                RejtP0fae2TzXlTgn/c32fF0dmsmOize2hJ5U5DvoP/HrEOJBgynRbItdcUm+cNp
                yAy6amc3IeOExOuhOBGWtG1Kg6J7ruIUSwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAo2gbZIzevqBN7DIXOMg8OdAZ2avV4gjWy+Ru15LECTlT7QXnAVfy
                aTwpLNjaQgJi3H6W30Y1CwQdy5tna3YmuBy7zsEGsSfxI9859gg+pzSzvmmmqCTu
                wCx5Rm0HPATdzsxZ/dT53wL2SRs/tbPj0nNfHeK5G+05nEe4nnQUjUp2CpMLxN7M
                mvpb3jFoFnV3hZnhjAM+dHz3IUFY83uZ6tCmTt9hKHmQexMjEveSnKGfRZ8g73M5
                qWp0+rMz6y8vmuVFDSdmW/0v5fiTZoNEb/B3YYJmr2MDT4IQH1WT13JU4M8gn4J+
                F55QMiZOHy7jRiZQMQ0vpIWYct327sK+EwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":39,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3847700,"bpjs":74425,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1R2HaeQ2K6+gi7Hu61LxelpW7hDcFhYah7wN6/96hqMIq6liZtOY
                MjpfNzZpQvcH8RUVOKVVQ6CpCUSalrNlneoQVhVCOOMsY4wsrlCaNhfqDnAUy+Pq
                g3GPKW02/hz38Mb7IZ1pNgD2P1doldJi4LhhnTongArDuKk3yTXX+2N7dHuqYqoU
                2wdjCHQlWwfkZd21pXI91sC8d1NU6gX1G9KK+27e8aQfXErTKO/kNQjablTtN+S2
                TNnoC4Uddsy+o9PH/8ll0ENiRfZCcRF9lIRjuib0LV2omHCspQl0JfGApDLRn8+u
                E9E+DMjS+W3XUSuG8x4b7CxX0QBA6PNVzwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3252900,"tjistri":325290,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":286255,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3552900,"bpjs":68974,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAyBOP6DAAckHg3JDN+Rwjo+Qnlh4zmSWDYU+Xxb8xy3wBWHrV3yow
                naNfXypvNIUSe+MyQ/9wvWDORazubb5QTaW4i6HWRSIzD6Qtfd8bJL9uxk7Gpz99
                thkM9i30h9lCGJod1wJ8I6VuZq72J9pAA464OKy0Iq3LOGOGpfw5INchfL3DR9q6
                SxhngvYP1s34pqToDQzy5XBAsxdzKUOtTDpRmEdDVrThFV2qJg0wdjoLir0mKkt6
                KeUt/+wIM6QZTa2Rvrlbw8WjUxJ7MNVD4YgWPLEBDyU6oeTA4Yru/nZNLJzc1Gug
                looNMhmqI+eGk4i3rLNZ5XrL0jJYiCDKlQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":4671600,"tjistri":467160,"tjanak":186864,"tjupns":0,"tjstruk":0,"tjfungs":960000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":289680,"tjpph":32876,"potpfkbul":0,"potpfk2":0,"potpfk10":426049,"potpph":32876,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":6040500,"bpjs":108807,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAngip29O1zxRnoxxL7lFToAl4KVsmTQZVOWXm+oDkOv7TvEu3Kl0W
                TO/bpp0IjNPV/7NpwBt7FYKTD6NDDGZA2o0w5ykg0hEm9PLM27GcTcqjtVgG93d+
                5DaCm8Gz9O7I/r3LSZTFtls3XpHrpfucHYVNxTQPFsKEkQ9aa67ySdXYJ9IpMK7O
                GatVwwrjCqM6bVDn3R8RFld9pHEsP68jyxLf+sO3lHuUOVNmfiWw8543WtymzRhQ
                Lgsz4nkHsrH9HGNF4HLbpbNdOr73W4z+xPPcAKCun80M8tHlxdhTlTt1NCuL3V9v
                bFqVB8ki/J2/LoGnm3dFpxnwL8JHwDp3lQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":65740,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":83,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":294515,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3715500,"bpjs":73768,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAlG1bOcktswGMm3OMbAQ8vQE5s+SbFKzFfuydQZgDqjv6qaasOShJ
                z/HccJVQRu0nCJkoFcJg2xp49leOJn/OAjk/9nKHrWu5NIq75jz7N+AKTBs/GQUm
                kRVRvxwDrqHoSUknb7kZ4TFFd7v75BAzXhGVY3jHLacZcfkVEHQ+JrTPpZEinQ+q
                hDNqaFJTs2G4QANug6Xv4K0lxjlyzNd9cp+HudCvjpavKYmhfK6QpqgAqAQ+O/nt
                OLFpIEK9zznnIMG2bhC7JYVrcyz8hNG0A+iUl/3BlkCnecFcOauG6eSUJiNTd69M
                zyPOUuzMOtKqg6Rg7/VSHGpqWahLLa9+NwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3426000,"tjistri":342600,"tjanak":68520,"tjupns":0,"tjstruk":0,"tjfungs":1100000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":306969,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":4747300,"bpjs":100163,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1bfVPoaKosUdFhyMzi9fyU/mGHZaO3Sfh8U/XVMy8JZJsc5NRH4C
                uoHodMteSNWpvGQGAk3bmQj+82OpmKRuks30JUy5DrqhyLR1x1p3LuK64JzFAP/7
                7M9xYz6Saxm5/KkS18GibKzp2Ekp2drD9oF74yBakSs6T6UgmvKeDfgIisSh2j6r
                2TtVMmKYXeVOWjrLIigJ8y9lpgrBu3SxZWVi/cvd0G9RjPk+EGnlhJdzLkoZuUrP
                1gLg/zyqySEskJRRSZdWvpJ5anW8GYB85KiJmsqhU5jYQ86sbVPhYESMeCF+WcxX
                4zDwDUxTwvqERp2opDmRfCg6HO0f9xBM5wIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3089300,"tjistri":308930,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":79,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":271858,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3381300,"bpjs":74991,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA0srayhisWCgrPQdxnGcPHf24q99yOxXcoK7BGZFwWBwYuThPzlg1
                NYdRuhg7hMQ9EvDcOHLTniU2g7lPfEBDsRkX/HP1uuzsF2KWYpy9tOXI9OECCHwU
                lu2bD1+5omjOdO61Ugg6Ftse3eyk0QJp0bpxefaA7PBzmYwhkxVYIR7fLFQemtLu
                KIrw/9TidZNEnWuN42/WfFrm8eQ6p0U3B+suug5/jV0VD+Aped/l0nsuKU/H7f2A
                7mRq+tDFSxarBvgDzUNWUJ02bTwdNp2QMMf6y0L+Afs5gcLA6rxjOBm0hO7t5IJA
                FW/ycDxIDOqGhT8M1azluz2f48Eai+bL2QIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":89,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3698900,"bpjs":74425,"bpjs2":148850}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAt+ofitI6wOK4z/WA0csV+wnbDlP9O4LvcY0PnLV4kKDi8PyOeohB
                vAvI8U+4Q4ha/08x0pqCdWFp25JSNWOt8MRG5KgshOVDcWYeqe5GzNfFkMdQVNEn
                pe3hoHxne6BQJbZGfavS63TV4Cja1M/NqgdEAmN3HfKzMJk3C7y8RTcqBfY/MoNL
                pTaLMfdCWciw1JUZn5I1lfNfjekJiSFhhlQGSTEPnpFukrOPZjFHLr4QKrVCzqR+
                JZBVFyqCDJFEjmuTjieSn0zAr5D2+p3prLy/mfZ2jnjo5iKrdoyisOY3Mc40EpVP
                ES7Od6N481lzLH0LFX06rx4MuBJKaG5RFwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3186600,"tjistri":318660,"tjanak":63732,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":10,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":285519,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3613100,"bpjs":72643,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAvSXf5LO86hVpbAG6yMm7RMt1CyQcv7FfqhznyzaF6wbsmq9Nfi6Z
                HgcwHR6PF0xV4aFJWeRDrXjzezyi49SbpJlfRE4xqZp58gG+OhTRfOxWma+1hhbe
                gKescD4Ky53Qir3KykffI92j2yUQxEKBjRMvSBX7DgySag08JiK6StPPKFR+7ash
                +mOYSppwrQHEdNvi6Ox+1ieRuKyR44UEgF+Dq5Txs9g4jxV8ZCsrQ6nLv7dQDlo9
                HZ6e8L7l7Fxmht8DUZHGK1UWeYgUXrpxUXT3LGm3FqdlOrzK58qOJ7Z/VMdtnkNf
                rKBGwIw+ihHsn8RIMlTT0Axe2aVzNR8ZMQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":256420,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":225649,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2854800,"bpjs":65110,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAl7aWV12N0/pjuuKRzNDKFdL2kl4Jmd42fbtLBu25jY4egmtWW4p/
                bm1YC7E6tmU4UV6MViAafY4kz3NsEljY7HZdulkGGQEqXlLoI5EqrhEg7jRSiAQq
                Pj5Cige4Io/FCxVUj1rN0LHvXeIihFPz6NZQVITdPTjGj+lJfSQxr/Jjn6hM+2W9
                To+EAEpiE8QEjOP9WKEm2H0aSSreq90mpgWpMUFSmgFjr/PLkDXBEXpxNTJnRyjH
                Uk3Cse37ZiR7ioKmUiNZ12hGMpYOu6TYuqaAtr8psqAUbu2ONbh7WpMpJnd/w2dO
                fOuIawvof86lF3qQghKzM4atonkgeB6EZwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAw6GzSZd7l7lHIugUGvjmODjzAqAMA2zgHVNhP949UU0RCWeHvTuk
                pjhPljUUFz+JGfou8behUianj3XgVjZkLiQ+QkJMTBf/AFnSwPftykwo6NHW822X
                cy98qHQ1w9p2vh4KGoyim/BPunWWnhuNb+TwdHyVDcEK/LACNIMTnNBwnmpA2/+1
                MRsoWvo1FWXqKc3E9Ck0A9EfMEEMOnqei/uDFYVgVVDblwmpCNaw2n2E0eoY6j0Z
                RejtP0fae2TzXlTgn/c32fF0dmsmOize2hJ5U5DvoP/HrEOJBgynRbItdcUm+cNp
                yAy6amc3IeOExOuhOBGWtG1Kg6J7ruIUSwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAo2gbZIzevqBN7DIXOMg8OdAZ2avV4gjWy+Ru15LECTlT7QXnAVfy
                aTwpLNjaQgJi3H6W30Y1CwQdy5tna3YmuBy7zsEGsSfxI9859gg+pzSzvmmmqCTu
                wCx5Rm0HPATdzsxZ/dT53wL2SRs/tbPj0nNfHeK5G+05nEe4nnQUjUp2CpMLxN7M
                mvpb3jFoFnV3hZnhjAM+dHz3IUFY83uZ6tCmTt9hKHmQexMjEveSnKGfRZ8g73M5
                qWp0+rMz6y8vmuVFDSdmW/0v5fiTZoNEb/B3YYJmr2MDT4IQH1WT13JU4M8gn4J+
                F55QMiZOHy7jRiZQMQ0vpIWYct327sK+EwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":39,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3847700,"bpjs":74425,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1R2HaeQ2K6+gi7Hu61LxelpW7hDcFhYah7wN6/96hqMIq6liZtOY
                MjpfNzZpQvcH8RUVOKVVQ6CpCUSalrNlneoQVhVCOOMsY4wsrlCaNhfqDnAUy+Pq
                g3GPKW02/hz38Mb7IZ1pNgD2P1doldJi4LhhnTongArDuKk3yTXX+2N7dHuqYqoU
                2wdjCHQlWwfkZd21pXI91sC8d1NU6gX1G9KK+27e8aQfXErTKO/kNQjablTtN+S2
                TNnoC4Uddsy+o9PH/8ll0ENiRfZCcRF9lIRjuib0LV2omHCspQl0JfGApDLRn8+u
                E9E+DMjS+W3XUSuG8x4b7CxX0QBA6PNVzwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3252900,"tjistri":325290,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":286255,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3552900,"bpjs":68974,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAyBOP6DAAckHg3JDN+Rwjo+Qnlh4zmSWDYU+Xxb8xy3wBWHrV3yow
                naNfXypvNIUSe+MyQ/9wvWDORazubb5QTaW4i6HWRSIzD6Qtfd8bJL9uxk7Gpz99
                thkM9i30h9lCGJod1wJ8I6VuZq72J9pAA464OKy0Iq3LOGOGpfw5INchfL3DR9q6
                SxhngvYP1s34pqToDQzy5XBAsxdzKUOtTDpRmEdDVrThFV2qJg0wdjoLir0mKkt6
                KeUt/+wIM6QZTa2Rvrlbw8WjUxJ7MNVD4YgWPLEBDyU6oeTA4Yru/nZNLJzc1Gug
                looNMhmqI+eGk4i3rLNZ5XrL0jJYiCDKlQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":4671600,"tjistri":467160,"tjanak":186864,"tjupns":0,"tjstruk":0,"tjfungs":960000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":289680,"tjpph":32876,"potpfkbul":0,"potpfk2":0,"potpfk10":426049,"potpph":32876,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":6040500,"bpjs":108807,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAngip29O1zxRnoxxL7lFToAl4KVsmTQZVOWXm+oDkOv7TvEu3Kl0W
                TO/bpp0IjNPV/7NpwBt7FYKTD6NDDGZA2o0w5ykg0hEm9PLM27GcTcqjtVgG93d+
                5DaCm8Gz9O7I/r3LSZTFtls3XpHrpfucHYVNxTQPFsKEkQ9aa67ySdXYJ9IpMK7O
                GatVwwrjCqM6bVDn3R8RFld9pHEsP68jyxLf+sO3lHuUOVNmfiWw8543WtymzRhQ
                Lgsz4nkHsrH9HGNF4HLbpbNdOr73W4z+xPPcAKCun80M8tHlxdhTlTt1NCuL3V9v
                bFqVB8ki/J2/LoGnm3dFpxnwL8JHwDp3lQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":65740,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":83,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":294515,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3715500,"bpjs":73768,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAlG1bOcktswGMm3OMbAQ8vQE5s+SbFKzFfuydQZgDqjv6qaasOShJ
                z/HccJVQRu0nCJkoFcJg2xp49leOJn/OAjk/9nKHrWu5NIq75jz7N+AKTBs/GQUm
                kRVRvxwDrqHoSUknb7kZ4TFFd7v75BAzXhGVY3jHLacZcfkVEHQ+JrTPpZEinQ+q
                hDNqaFJTs2G4QANug6Xv4K0lxjlyzNd9cp+HudCvjpavKYmhfK6QpqgAqAQ+O/nt
                OLFpIEK9zznnIMG2bhC7JYVrcyz8hNG0A+iUl/3BlkCnecFcOauG6eSUJiNTd69M
                zyPOUuzMOtKqg6Rg7/VSHGpqWahLLa9+NwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3426000,"tjistri":342600,"tjanak":68520,"tjupns":0,"tjstruk":0,"tjfungs":1100000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":306969,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":4747300,"bpjs":100163,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1bfVPoaKosUdFhyMzi9fyU/mGHZaO3Sfh8U/XVMy8JZJsc5NRH4C
                uoHodMteSNWpvGQGAk3bmQj+82OpmKRuks30JUy5DrqhyLR1x1p3LuK64JzFAP/7
                7M9xYz6Saxm5/KkS18GibKzp2Ekp2drD9oF74yBakSs6T6UgmvKeDfgIisSh2j6r
                2TtVMmKYXeVOWjrLIigJ8y9lpgrBu3SxZWVi/cvd0G9RjPk+EGnlhJdzLkoZuUrP
                1gLg/zyqySEskJRRSZdWvpJ5anW8GYB85KiJmsqhU5jYQ86sbVPhYESMeCF+WcxX
                4zDwDUxTwvqERp2opDmRfCg6HO0f9xBM5wIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3089300,"tjistri":308930,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":79,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":271858,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3381300,"bpjs":74991,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA0srayhisWCgrPQdxnGcPHf24q99yOxXcoK7BGZFwWBwYuThPzlg1
                NYdRuhg7hMQ9EvDcOHLTniU2g7lPfEBDsRkX/HP1uuzsF2KWYpy9tOXI9OECCHwU
                lu2bD1+5omjOdO61Ugg6Ftse3eyk0QJp0bpxefaA7PBzmYwhkxVYIR7fLFQemtLu
                KIrw/9TidZNEnWuN42/WfFrm8eQ6p0U3B+suug5/jV0VD+Aped/l0nsuKU/H7f2A
                7mRq+tDFSxarBvgDzUNWUJ02bTwdNp2QMMf6y0L+Afs5gcLA6rxjOBm0hO7t5IJA
                FW/ycDxIDOqGhT8M1azluz2f48Eai+bL2QIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":89,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3698900,"bpjs":74425,"bpjs2":148850}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAt+ofitI6wOK4z/WA0csV+wnbDlP9O4LvcY0PnLV4kKDi8PyOeohB
                vAvI8U+4Q4ha/08x0pqCdWFp25JSNWOt8MRG5KgshOVDcWYeqe5GzNfFkMdQVNEn
                pe3hoHxne6BQJbZGfavS63TV4Cja1M/NqgdEAmN3HfKzMJk3C7y8RTcqBfY/MoNL
                pTaLMfdCWciw1JUZn5I1lfNfjekJiSFhhlQGSTEPnpFukrOPZjFHLr4QKrVCzqR+
                JZBVFyqCDJFEjmuTjieSn0zAr5D2+p3prLy/mfZ2jnjo5iKrdoyisOY3Mc40EpVP
                ES7Od6N481lzLH0LFX06rx4MuBJKaG5RFwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3186600,"tjistri":318660,"tjanak":63732,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":10,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":285519,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3613100,"bpjs":72643,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAvSXf5LO86hVpbAG6yMm7RMt1CyQcv7FfqhznyzaF6wbsmq9Nfi6Z
                HgcwHR6PF0xV4aFJWeRDrXjzezyi49SbpJlfRE4xqZp58gG+OhTRfOxWma+1hhbe
                gKescD4Ky53Qir3KykffI92j2yUQxEKBjRMvSBX7DgySag08JiK6StPPKFR+7ash
                +mOYSppwrQHEdNvi6Ox+1ieRuKyR44UEgF+Dq5Txs9g4jxV8ZCsrQ6nLv7dQDlo9
                HZ6e8L7l7Fxmht8DUZHGK1UWeYgUXrpxUXT3LGm3FqdlOrzK58qOJ7Z/VMdtnkNf
                rKBGwIw+ihHsn8RIMlTT0Axe2aVzNR8ZMQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":256420,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":225649,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2854800,"bpjs":65110,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAl7aWV12N0/pjuuKRzNDKFdL2kl4Jmd42fbtLBu25jY4egmtWW4p/
                bm1YC7E6tmU4UV6MViAafY4kz3NsEljY7HZdulkGGQEqXlLoI5EqrhEg7jRSiAQq
                Pj5Cige4Io/FCxVUj1rN0LHvXeIihFPz6NZQVITdPTjGj+lJfSQxr/Jjn6hM+2W9
                To+EAEpiE8QEjOP9WKEm2H0aSSreq90mpgWpMUFSmgFjr/PLkDXBEXpxNTJnRyjH
                Uk3Cse37ZiR7ioKmUiNZ12hGMpYOu6TYuqaAtr8psqAUbu2ONbh7WpMpJnd/w2dO
                fOuIawvof86lF3qQghKzM4atonkgeB6EZwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAw6GzSZd7l7lHIugUGvjmODjzAqAMA2zgHVNhP949UU0RCWeHvTuk
                pjhPljUUFz+JGfou8behUianj3XgVjZkLiQ+QkJMTBf/AFnSwPftykwo6NHW822X
                cy98qHQ1w9p2vh4KGoyim/BPunWWnhuNb+TwdHyVDcEK/LACNIMTnNBwnmpA2/+1
                MRsoWvo1FWXqKc3E9Ck0A9EfMEEMOnqei/uDFYVgVVDblwmpCNaw2n2E0eoY6j0Z
                RejtP0fae2TzXlTgn/c32fF0dmsmOize2hJ5U5DvoP/HrEOJBgynRbItdcUm+cNp
                yAy6amc3IeOExOuhOBGWtG1Kg6J7ruIUSwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAo2gbZIzevqBN7DIXOMg8OdAZ2avV4gjWy+Ru15LECTlT7QXnAVfy
                aTwpLNjaQgJi3H6W30Y1CwQdy5tna3YmuBy7zsEGsSfxI9859gg+pzSzvmmmqCTu
                wCx5Rm0HPATdzsxZ/dT53wL2SRs/tbPj0nNfHeK5G+05nEe4nnQUjUp2CpMLxN7M
                mvpb3jFoFnV3hZnhjAM+dHz3IUFY83uZ6tCmTt9hKHmQexMjEveSnKGfRZ8g73M5
                qWp0+rMz6y8vmuVFDSdmW/0v5fiTZoNEb/B3YYJmr2MDT4IQH1WT13JU4M8gn4J+
                F55QMiZOHy7jRiZQMQ0vpIWYct327sK+EwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":39,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3847700,"bpjs":74425,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1R2HaeQ2K6+gi7Hu61LxelpW7hDcFhYah7wN6/96hqMIq6liZtOY
                MjpfNzZpQvcH8RUVOKVVQ6CpCUSalrNlneoQVhVCOOMsY4wsrlCaNhfqDnAUy+Pq
                g3GPKW02/hz38Mb7IZ1pNgD2P1doldJi4LhhnTongArDuKk3yTXX+2N7dHuqYqoU
                2wdjCHQlWwfkZd21pXI91sC8d1NU6gX1G9KK+27e8aQfXErTKO/kNQjablTtN+S2
                TNnoC4Uddsy+o9PH/8ll0ENiRfZCcRF9lIRjuib0LV2omHCspQl0JfGApDLRn8+u
                E9E+DMjS+W3XUSuG8x4b7CxX0QBA6PNVzwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3252900,"tjistri":325290,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":286255,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3552900,"bpjs":68974,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAyBOP6DAAckHg3JDN+Rwjo+Qnlh4zmSWDYU+Xxb8xy3wBWHrV3yow
                naNfXypvNIUSe+MyQ/9wvWDORazubb5QTaW4i6HWRSIzD6Qtfd8bJL9uxk7Gpz99
                thkM9i30h9lCGJod1wJ8I6VuZq72J9pAA464OKy0Iq3LOGOGpfw5INchfL3DR9q6
                SxhngvYP1s34pqToDQzy5XBAsxdzKUOtTDpRmEdDVrThFV2qJg0wdjoLir0mKkt6
                KeUt/+wIM6QZTa2Rvrlbw8WjUxJ7MNVD4YgWPLEBDyU6oeTA4Yru/nZNLJzc1Gug
                looNMhmqI+eGk4i3rLNZ5XrL0jJYiCDKlQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":4671600,"tjistri":467160,"tjanak":186864,"tjupns":0,"tjstruk":0,"tjfungs":960000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":289680,"tjpph":32876,"potpfkbul":0,"potpfk2":0,"potpfk10":426049,"potpph":32876,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":6040500,"bpjs":108807,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAngip29O1zxRnoxxL7lFToAl4KVsmTQZVOWXm+oDkOv7TvEu3Kl0W
                TO/bpp0IjNPV/7NpwBt7FYKTD6NDDGZA2o0w5ykg0hEm9PLM27GcTcqjtVgG93d+
                5DaCm8Gz9O7I/r3LSZTFtls3XpHrpfucHYVNxTQPFsKEkQ9aa67ySdXYJ9IpMK7O
                GatVwwrjCqM6bVDn3R8RFld9pHEsP68jyxLf+sO3lHuUOVNmfiWw8543WtymzRhQ
                Lgsz4nkHsrH9HGNF4HLbpbNdOr73W4z+xPPcAKCun80M8tHlxdhTlTt1NCuL3V9v
                bFqVB8ki/J2/LoGnm3dFpxnwL8JHwDp3lQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":65740,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":83,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":294515,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3715500,"bpjs":73768,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAlG1bOcktswGMm3OMbAQ8vQE5s+SbFKzFfuydQZgDqjv6qaasOShJ
                z/HccJVQRu0nCJkoFcJg2xp49leOJn/OAjk/9nKHrWu5NIq75jz7N+AKTBs/GQUm
                kRVRvxwDrqHoSUknb7kZ4TFFd7v75BAzXhGVY3jHLacZcfkVEHQ+JrTPpZEinQ+q
                hDNqaFJTs2G4QANug6Xv4K0lxjlyzNd9cp+HudCvjpavKYmhfK6QpqgAqAQ+O/nt
                OLFpIEK9zznnIMG2bhC7JYVrcyz8hNG0A+iUl/3BlkCnecFcOauG6eSUJiNTd69M
                zyPOUuzMOtKqg6Rg7/VSHGpqWahLLa9+NwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3426000,"tjistri":342600,"tjanak":68520,"tjupns":0,"tjstruk":0,"tjfungs":1100000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":306969,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":4747300,"bpjs":100163,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1bfVPoaKosUdFhyMzi9fyU/mGHZaO3Sfh8U/XVMy8JZJsc5NRH4C
                uoHodMteSNWpvGQGAk3bmQj+82OpmKRuks30JUy5DrqhyLR1x1p3LuK64JzFAP/7
                7M9xYz6Saxm5/KkS18GibKzp2Ekp2drD9oF74yBakSs6T6UgmvKeDfgIisSh2j6r
                2TtVMmKYXeVOWjrLIigJ8y9lpgrBu3SxZWVi/cvd0G9RjPk+EGnlhJdzLkoZuUrP
                1gLg/zyqySEskJRRSZdWvpJ5anW8GYB85KiJmsqhU5jYQ86sbVPhYESMeCF+WcxX
                4zDwDUxTwvqERp2opDmRfCg6HO0f9xBM5wIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3089300,"tjistri":308930,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":79,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":271858,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3381300,"bpjs":74991,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA0srayhisWCgrPQdxnGcPHf24q99yOxXcoK7BGZFwWBwYuThPzlg1
                NYdRuhg7hMQ9EvDcOHLTniU2g7lPfEBDsRkX/HP1uuzsF2KWYpy9tOXI9OECCHwU
                lu2bD1+5omjOdO61Ugg6Ftse3eyk0QJp0bpxefaA7PBzmYwhkxVYIR7fLFQemtLu
                KIrw/9TidZNEnWuN42/WfFrm8eQ6p0U3B+suug5/jV0VD+Aped/l0nsuKU/H7f2A
                7mRq+tDFSxarBvgDzUNWUJ02bTwdNp2QMMf6y0L+Afs5gcLA6rxjOBm0hO7t5IJA
                FW/ycDxIDOqGhT8M1azluz2f48Eai+bL2QIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":89,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3698900,"bpjs":74425,"bpjs2":148850}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAt+ofitI6wOK4z/WA0csV+wnbDlP9O4LvcY0PnLV4kKDi8PyOeohB
                vAvI8U+4Q4ha/08x0pqCdWFp25JSNWOt8MRG5KgshOVDcWYeqe5GzNfFkMdQVNEn
                pe3hoHxne6BQJbZGfavS63TV4Cja1M/NqgdEAmN3HfKzMJk3C7y8RTcqBfY/MoNL
                pTaLMfdCWciw1JUZn5I1lfNfjekJiSFhhlQGSTEPnpFukrOPZjFHLr4QKrVCzqR+
                JZBVFyqCDJFEjmuTjieSn0zAr5D2+p3prLy/mfZ2jnjo5iKrdoyisOY3Mc40EpVP
                ES7Od6N481lzLH0LFX06rx4MuBJKaG5RFwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3186600,"tjistri":318660,"tjanak":63732,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":10,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":285519,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3613100,"bpjs":72643,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAvSXf5LO86hVpbAG6yMm7RMt1CyQcv7FfqhznyzaF6wbsmq9Nfi6Z
                HgcwHR6PF0xV4aFJWeRDrXjzezyi49SbpJlfRE4xqZp58gG+OhTRfOxWma+1hhbe
                gKescD4Ky53Qir3KykffI92j2yUQxEKBjRMvSBX7DgySag08JiK6StPPKFR+7ash
                +mOYSppwrQHEdNvi6Ox+1ieRuKyR44UEgF+Dq5Txs9g4jxV8ZCsrQ6nLv7dQDlo9
                HZ6e8L7l7Fxmht8DUZHGK1UWeYgUXrpxUXT3LGm3FqdlOrzK58qOJ7Z/VMdtnkNf
                rKBGwIw+ihHsn8RIMlTT0Axe2aVzNR8ZMQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":256420,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":225649,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2854800,"bpjs":65110,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAl7aWV12N0/pjuuKRzNDKFdL2kl4Jmd42fbtLBu25jY4egmtWW4p/
                bm1YC7E6tmU4UV6MViAafY4kz3NsEljY7HZdulkGGQEqXlLoI5EqrhEg7jRSiAQq
                Pj5Cige4Io/FCxVUj1rN0LHvXeIihFPz6NZQVITdPTjGj+lJfSQxr/Jjn6hM+2W9
                To+EAEpiE8QEjOP9WKEm2H0aSSreq90mpgWpMUFSmgFjr/PLkDXBEXpxNTJnRyjH
                Uk3Cse37ZiR7ioKmUiNZ12hGMpYOu6TYuqaAtr8psqAUbu2ONbh7WpMpJnd/w2dO
                fOuIawvof86lF3qQghKzM4atonkgeB6EZwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAw6GzSZd7l7lHIugUGvjmODjzAqAMA2zgHVNhP949UU0RCWeHvTuk
                pjhPljUUFz+JGfou8behUianj3XgVjZkLiQ+QkJMTBf/AFnSwPftykwo6NHW822X
                cy98qHQ1w9p2vh4KGoyim/BPunWWnhuNb+TwdHyVDcEK/LACNIMTnNBwnmpA2/+1
                MRsoWvo1FWXqKc3E9Ck0A9EfMEEMOnqei/uDFYVgVVDblwmpCNaw2n2E0eoY6j0Z
                RejtP0fae2TzXlTgn/c32fF0dmsmOize2hJ5U5DvoP/HrEOJBgynRbItdcUm+cNp
                yAy6amc3IeOExOuhOBGWtG1Kg6J7ruIUSwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAo2gbZIzevqBN7DIXOMg8OdAZ2avV4gjWy+Ru15LECTlT7QXnAVfy
                aTwpLNjaQgJi3H6W30Y1CwQdy5tna3YmuBy7zsEGsSfxI9859gg+pzSzvmmmqCTu
                wCx5Rm0HPATdzsxZ/dT53wL2SRs/tbPj0nNfHeK5G+05nEe4nnQUjUp2CpMLxN7M
                mvpb3jFoFnV3hZnhjAM+dHz3IUFY83uZ6tCmTt9hKHmQexMjEveSnKGfRZ8g73M5
                qWp0+rMz6y8vmuVFDSdmW/0v5fiTZoNEb/B3YYJmr2MDT4IQH1WT13JU4M8gn4J+
                F55QMiZOHy7jRiZQMQ0vpIWYct327sK+EwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":39,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3847700,"bpjs":74425,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1R2HaeQ2K6+gi7Hu61LxelpW7hDcFhYah7wN6/96hqMIq6liZtOY
                MjpfNzZpQvcH8RUVOKVVQ6CpCUSalrNlneoQVhVCOOMsY4wsrlCaNhfqDnAUy+Pq
                g3GPKW02/hz38Mb7IZ1pNgD2P1doldJi4LhhnTongArDuKk3yTXX+2N7dHuqYqoU
                2wdjCHQlWwfkZd21pXI91sC8d1NU6gX1G9KK+27e8aQfXErTKO/kNQjablTtN+S2
                TNnoC4Uddsy+o9PH/8ll0ENiRfZCcRF9lIRjuib0LV2omHCspQl0JfGApDLRn8+u
                E9E+DMjS+W3XUSuG8x4b7CxX0QBA6PNVzwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3252900,"tjistri":325290,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":286255,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3552900,"bpjs":68974,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAyBOP6DAAckHg3JDN+Rwjo+Qnlh4zmSWDYU+Xxb8xy3wBWHrV3yow
                naNfXypvNIUSe+MyQ/9wvWDORazubb5QTaW4i6HWRSIzD6Qtfd8bJL9uxk7Gpz99
                thkM9i30h9lCGJod1wJ8I6VuZq72J9pAA464OKy0Iq3LOGOGpfw5INchfL3DR9q6
                SxhngvYP1s34pqToDQzy5XBAsxdzKUOtTDpRmEdDVrThFV2qJg0wdjoLir0mKkt6
                KeUt/+wIM6QZTa2Rvrlbw8WjUxJ7MNVD4YgWPLEBDyU6oeTA4Yru/nZNLJzc1Gug
                looNMhmqI+eGk4i3rLNZ5XrL0jJYiCDKlQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":4671600,"tjistri":467160,"tjanak":186864,"tjupns":0,"tjstruk":0,"tjfungs":960000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":289680,"tjpph":32876,"potpfkbul":0,"potpfk2":0,"potpfk10":426049,"potpph":32876,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":6040500,"bpjs":108807,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAngip29O1zxRnoxxL7lFToAl4KVsmTQZVOWXm+oDkOv7TvEu3Kl0W
                TO/bpp0IjNPV/7NpwBt7FYKTD6NDDGZA2o0w5ykg0hEm9PLM27GcTcqjtVgG93d+
                5DaCm8Gz9O7I/r3LSZTFtls3XpHrpfucHYVNxTQPFsKEkQ9aa67ySdXYJ9IpMK7O
                GatVwwrjCqM6bVDn3R8RFld9pHEsP68jyxLf+sO3lHuUOVNmfiWw8543WtymzRhQ
                Lgsz4nkHsrH9HGNF4HLbpbNdOr73W4z+xPPcAKCun80M8tHlxdhTlTt1NCuL3V9v
                bFqVB8ki/J2/LoGnm3dFpxnwL8JHwDp3lQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":65740,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":83,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":294515,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3715500,"bpjs":73768,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAlG1bOcktswGMm3OMbAQ8vQE5s+SbFKzFfuydQZgDqjv6qaasOShJ
                z/HccJVQRu0nCJkoFcJg2xp49leOJn/OAjk/9nKHrWu5NIq75jz7N+AKTBs/GQUm
                kRVRvxwDrqHoSUknb7kZ4TFFd7v75BAzXhGVY3jHLacZcfkVEHQ+JrTPpZEinQ+q
                hDNqaFJTs2G4QANug6Xv4K0lxjlyzNd9cp+HudCvjpavKYmhfK6QpqgAqAQ+O/nt
                OLFpIEK9zznnIMG2bhC7JYVrcyz8hNG0A+iUl/3BlkCnecFcOauG6eSUJiNTd69M
                zyPOUuzMOtKqg6Rg7/VSHGpqWahLLa9+NwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3426000,"tjistri":342600,"tjanak":68520,"tjupns":0,"tjstruk":0,"tjfungs":1100000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":306969,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":4747300,"bpjs":100163,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1bfVPoaKosUdFhyMzi9fyU/mGHZaO3Sfh8U/XVMy8JZJsc5NRH4C
                uoHodMteSNWpvGQGAk3bmQj+82OpmKRuks30JUy5DrqhyLR1x1p3LuK64JzFAP/7
                7M9xYz6Saxm5/KkS18GibKzp2Ekp2drD9oF74yBakSs6T6UgmvKeDfgIisSh2j6r
                2TtVMmKYXeVOWjrLIigJ8y9lpgrBu3SxZWVi/cvd0G9RjPk+EGnlhJdzLkoZuUrP
                1gLg/zyqySEskJRRSZdWvpJ5anW8GYB85KiJmsqhU5jYQ86sbVPhYESMeCF+WcxX
                4zDwDUxTwvqERp2opDmRfCg6HO0f9xBM5wIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3089300,"tjistri":308930,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":79,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":271858,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3381300,"bpjs":74991,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA0srayhisWCgrPQdxnGcPHf24q99yOxXcoK7BGZFwWBwYuThPzlg1
                NYdRuhg7hMQ9EvDcOHLTniU2g7lPfEBDsRkX/HP1uuzsF2KWYpy9tOXI9OECCHwU
                lu2bD1+5omjOdO61Ugg6Ftse3eyk0QJp0bpxefaA7PBzmYwhkxVYIR7fLFQemtLu
                KIrw/9TidZNEnWuN42/WfFrm8eQ6p0U3B+suug5/jV0VD+Aped/l0nsuKU/H7f2A
                7mRq+tDFSxarBvgDzUNWUJ02bTwdNp2QMMf6y0L+Afs5gcLA6rxjOBm0hO7t5IJA
                FW/ycDxIDOqGhT8M1azluz2f48Eai+bL2QIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":89,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3698900,"bpjs":74425,"bpjs2":148850}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAt+ofitI6wOK4z/WA0csV+wnbDlP9O4LvcY0PnLV4kKDi8PyOeohB
                vAvI8U+4Q4ha/08x0pqCdWFp25JSNWOt8MRG5KgshOVDcWYeqe5GzNfFkMdQVNEn
                pe3hoHxne6BQJbZGfavS63TV4Cja1M/NqgdEAmN3HfKzMJk3C7y8RTcqBfY/MoNL
                pTaLMfdCWciw1JUZn5I1lfNfjekJiSFhhlQGSTEPnpFukrOPZjFHLr4QKrVCzqR+
                JZBVFyqCDJFEjmuTjieSn0zAr5D2+p3prLy/mfZ2jnjo5iKrdoyisOY3Mc40EpVP
                ES7Od6N481lzLH0LFX06rx4MuBJKaG5RFwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3186600,"tjistri":318660,"tjanak":63732,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":10,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":285519,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3613100,"bpjs":72643,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAvSXf5LO86hVpbAG6yMm7RMt1CyQcv7FfqhznyzaF6wbsmq9Nfi6Z
                HgcwHR6PF0xV4aFJWeRDrXjzezyi49SbpJlfRE4xqZp58gG+OhTRfOxWma+1hhbe
                gKescD4Ky53Qir3KykffI92j2yUQxEKBjRMvSBX7DgySag08JiK6StPPKFR+7ash
                +mOYSppwrQHEdNvi6Ox+1ieRuKyR44UEgF+Dq5Txs9g4jxV8ZCsrQ6nLv7dQDlo9
                HZ6e8L7l7Fxmht8DUZHGK1UWeYgUXrpxUXT3LGm3FqdlOrzK58qOJ7Z/VMdtnkNf
                rKBGwIw+ihHsn8RIMlTT0Axe2aVzNR8ZMQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":256420,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":225649,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2854800,"bpjs":65110,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAl7aWV12N0/pjuuKRzNDKFdL2kl4Jmd42fbtLBu25jY4egmtWW4p/
                bm1YC7E6tmU4UV6MViAafY4kz3NsEljY7HZdulkGGQEqXlLoI5EqrhEg7jRSiAQq
                Pj5Cige4Io/FCxVUj1rN0LHvXeIihFPz6NZQVITdPTjGj+lJfSQxr/Jjn6hM+2W9
                To+EAEpiE8QEjOP9WKEm2H0aSSreq90mpgWpMUFSmgFjr/PLkDXBEXpxNTJnRyjH
                Uk3Cse37ZiR7ioKmUiNZ12hGMpYOu6TYuqaAtr8psqAUbu2ONbh7WpMpJnd/w2dO
                fOuIawvof86lF3qQghKzM4atonkgeB6EZwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAw6GzSZd7l7lHIugUGvjmODjzAqAMA2zgHVNhP949UU0RCWeHvTuk
                pjhPljUUFz+JGfou8behUianj3XgVjZkLiQ+QkJMTBf/AFnSwPftykwo6NHW822X
                cy98qHQ1w9p2vh4KGoyim/BPunWWnhuNb+TwdHyVDcEK/LACNIMTnNBwnmpA2/+1
                MRsoWvo1FWXqKc3E9Ck0A9EfMEEMOnqei/uDFYVgVVDblwmpCNaw2n2E0eoY6j0Z
                RejtP0fae2TzXlTgn/c32fF0dmsmOize2hJ5U5DvoP/HrEOJBgynRbItdcUm+cNp
                yAy6amc3IeOExOuhOBGWtG1Kg6J7ruIUSwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAo2gbZIzevqBN7DIXOMg8OdAZ2avV4gjWy+Ru15LECTlT7QXnAVfy
                aTwpLNjaQgJi3H6W30Y1CwQdy5tna3YmuBy7zsEGsSfxI9859gg+pzSzvmmmqCTu
                wCx5Rm0HPATdzsxZ/dT53wL2SRs/tbPj0nNfHeK5G+05nEe4nnQUjUp2CpMLxN7M
                mvpb3jFoFnV3hZnhjAM+dHz3IUFY83uZ6tCmTt9hKHmQexMjEveSnKGfRZ8g73M5
                qWp0+rMz6y8vmuVFDSdmW/0v5fiTZoNEb/B3YYJmr2MDT4IQH1WT13JU4M8gn4J+
                F55QMiZOHy7jRiZQMQ0vpIWYct327sK+EwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":39,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3847700,"bpjs":74425,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1R2HaeQ2K6+gi7Hu61LxelpW7hDcFhYah7wN6/96hqMIq6liZtOY
                MjpfNzZpQvcH8RUVOKVVQ6CpCUSalrNlneoQVhVCOOMsY4wsrlCaNhfqDnAUy+Pq
                g3GPKW02/hz38Mb7IZ1pNgD2P1doldJi4LhhnTongArDuKk3yTXX+2N7dHuqYqoU
                2wdjCHQlWwfkZd21pXI91sC8d1NU6gX1G9KK+27e8aQfXErTKO/kNQjablTtN+S2
                TNnoC4Uddsy+o9PH/8ll0ENiRfZCcRF9lIRjuib0LV2omHCspQl0JfGApDLRn8+u
                E9E+DMjS+W3XUSuG8x4b7CxX0QBA6PNVzwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3252900,"tjistri":325290,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":286255,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3552900,"bpjs":68974,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAyBOP6DAAckHg3JDN+Rwjo+Qnlh4zmSWDYU+Xxb8xy3wBWHrV3yow
                naNfXypvNIUSe+MyQ/9wvWDORazubb5QTaW4i6HWRSIzD6Qtfd8bJL9uxk7Gpz99
                thkM9i30h9lCGJod1wJ8I6VuZq72J9pAA464OKy0Iq3LOGOGpfw5INchfL3DR9q6
                SxhngvYP1s34pqToDQzy5XBAsxdzKUOtTDpRmEdDVrThFV2qJg0wdjoLir0mKkt6
                KeUt/+wIM6QZTa2Rvrlbw8WjUxJ7MNVD4YgWPLEBDyU6oeTA4Yru/nZNLJzc1Gug
                looNMhmqI+eGk4i3rLNZ5XrL0jJYiCDKlQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":4671600,"tjistri":467160,"tjanak":186864,"tjupns":0,"tjstruk":0,"tjfungs":960000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":289680,"tjpph":32876,"potpfkbul":0,"potpfk2":0,"potpfk10":426049,"potpph":32876,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":6040500,"bpjs":108807,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAngip29O1zxRnoxxL7lFToAl4KVsmTQZVOWXm+oDkOv7TvEu3Kl0W
                TO/bpp0IjNPV/7NpwBt7FYKTD6NDDGZA2o0w5ykg0hEm9PLM27GcTcqjtVgG93d+
                5DaCm8Gz9O7I/r3LSZTFtls3XpHrpfucHYVNxTQPFsKEkQ9aa67ySdXYJ9IpMK7O
                GatVwwrjCqM6bVDn3R8RFld9pHEsP68jyxLf+sO3lHuUOVNmfiWw8543WtymzRhQ
                Lgsz4nkHsrH9HGNF4HLbpbNdOr73W4z+xPPcAKCun80M8tHlxdhTlTt1NCuL3V9v
                bFqVB8ki/J2/LoGnm3dFpxnwL8JHwDp3lQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":65740,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":83,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":294515,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3715500,"bpjs":73768,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAlG1bOcktswGMm3OMbAQ8vQE5s+SbFKzFfuydQZgDqjv6qaasOShJ
                z/HccJVQRu0nCJkoFcJg2xp49leOJn/OAjk/9nKHrWu5NIq75jz7N+AKTBs/GQUm
                kRVRvxwDrqHoSUknb7kZ4TFFd7v75BAzXhGVY3jHLacZcfkVEHQ+JrTPpZEinQ+q
                hDNqaFJTs2G4QANug6Xv4K0lxjlyzNd9cp+HudCvjpavKYmhfK6QpqgAqAQ+O/nt
                OLFpIEK9zznnIMG2bhC7JYVrcyz8hNG0A+iUl/3BlkCnecFcOauG6eSUJiNTd69M
                zyPOUuzMOtKqg6Rg7/VSHGpqWahLLa9+NwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3426000,"tjistri":342600,"tjanak":68520,"tjupns":0,"tjstruk":0,"tjfungs":1100000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":306969,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":4747300,"bpjs":100163,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1bfVPoaKosUdFhyMzi9fyU/mGHZaO3Sfh8U/XVMy8JZJsc5NRH4C
                uoHodMteSNWpvGQGAk3bmQj+82OpmKRuks30JUy5DrqhyLR1x1p3LuK64JzFAP/7
                7M9xYz6Saxm5/KkS18GibKzp2Ekp2drD9oF74yBakSs6T6UgmvKeDfgIisSh2j6r
                2TtVMmKYXeVOWjrLIigJ8y9lpgrBu3SxZWVi/cvd0G9RjPk+EGnlhJdzLkoZuUrP
                1gLg/zyqySEskJRRSZdWvpJ5anW8GYB85KiJmsqhU5jYQ86sbVPhYESMeCF+WcxX
                4zDwDUxTwvqERp2opDmRfCg6HO0f9xBM5wIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3089300,"tjistri":308930,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":79,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":271858,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3381300,"bpjs":74991,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA0srayhisWCgrPQdxnGcPHf24q99yOxXcoK7BGZFwWBwYuThPzlg1
                NYdRuhg7hMQ9EvDcOHLTniU2g7lPfEBDsRkX/HP1uuzsF2KWYpy9tOXI9OECCHwU
                lu2bD1+5omjOdO61Ugg6Ftse3eyk0QJp0bpxefaA7PBzmYwhkxVYIR7fLFQemtLu
                KIrw/9TidZNEnWuN42/WfFrm8eQ6p0U3B+suug5/jV0VD+Aped/l0nsuKU/H7f2A
                7mRq+tDFSxarBvgDzUNWUJ02bTwdNp2QMMf6y0L+Afs5gcLA6rxjOBm0hO7t5IJA
                FW/ycDxIDOqGhT8M1azluz2f48Eai+bL2QIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":89,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3698900,"bpjs":74425,"bpjs2":148850}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAt+ofitI6wOK4z/WA0csV+wnbDlP9O4LvcY0PnLV4kKDi8PyOeohB
                vAvI8U+4Q4ha/08x0pqCdWFp25JSNWOt8MRG5KgshOVDcWYeqe5GzNfFkMdQVNEn
                pe3hoHxne6BQJbZGfavS63TV4Cja1M/NqgdEAmN3HfKzMJk3C7y8RTcqBfY/MoNL
                pTaLMfdCWciw1JUZn5I1lfNfjekJiSFhhlQGSTEPnpFukrOPZjFHLr4QKrVCzqR+
                JZBVFyqCDJFEjmuTjieSn0zAr5D2+p3prLy/mfZ2jnjo5iKrdoyisOY3Mc40EpVP
                ES7Od6N481lzLH0LFX06rx4MuBJKaG5RFwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3186600,"tjistri":318660,"tjanak":63732,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":10,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":285519,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3613100,"bpjs":72643,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAvSXf5LO86hVpbAG6yMm7RMt1CyQcv7FfqhznyzaF6wbsmq9Nfi6Z
                HgcwHR6PF0xV4aFJWeRDrXjzezyi49SbpJlfRE4xqZp58gG+OhTRfOxWma+1hhbe
                gKescD4Ky53Qir3KykffI92j2yUQxEKBjRMvSBX7DgySag08JiK6StPPKFR+7ash
                +mOYSppwrQHEdNvi6Ox+1ieRuKyR44UEgF+Dq5Txs9g4jxV8ZCsrQ6nLv7dQDlo9
                HZ6e8L7l7Fxmht8DUZHGK1UWeYgUXrpxUXT3LGm3FqdlOrzK58qOJ7Z/VMdtnkNf
                rKBGwIw+ihHsn8RIMlTT0Axe2aVzNR8ZMQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":256420,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":225649,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2854800,"bpjs":65110,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAl7aWV12N0/pjuuKRzNDKFdL2kl4Jmd42fbtLBu25jY4egmtWW4p/
                bm1YC7E6tmU4UV6MViAafY4kz3NsEljY7HZdulkGGQEqXlLoI5EqrhEg7jRSiAQq
                Pj5Cige4Io/FCxVUj1rN0LHvXeIihFPz6NZQVITdPTjGj+lJfSQxr/Jjn6hM+2W9
                To+EAEpiE8QEjOP9WKEm2H0aSSreq90mpgWpMUFSmgFjr/PLkDXBEXpxNTJnRyjH
                Uk3Cse37ZiR7ioKmUiNZ12hGMpYOu6TYuqaAtr8psqAUbu2ONbh7WpMpJnd/w2dO
                fOuIawvof86lF3qQghKzM4atonkgeB6EZwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAw6GzSZd7l7lHIugUGvjmODjzAqAMA2zgHVNhP949UU0RCWeHvTuk
                pjhPljUUFz+JGfou8behUianj3XgVjZkLiQ+QkJMTBf/AFnSwPftykwo6NHW822X
                cy98qHQ1w9p2vh4KGoyim/BPunWWnhuNb+TwdHyVDcEK/LACNIMTnNBwnmpA2/+1
                MRsoWvo1FWXqKc3E9Ck0A9EfMEEMOnqei/uDFYVgVVDblwmpCNaw2n2E0eoY6j0Z
                RejtP0fae2TzXlTgn/c32fF0dmsmOize2hJ5U5DvoP/HrEOJBgynRbItdcUm+cNp
                yAy6amc3IeOExOuhOBGWtG1Kg6J7ruIUSwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAo2gbZIzevqBN7DIXOMg8OdAZ2avV4gjWy+Ru15LECTlT7QXnAVfy
                aTwpLNjaQgJi3H6W30Y1CwQdy5tna3YmuBy7zsEGsSfxI9859gg+pzSzvmmmqCTu
                wCx5Rm0HPATdzsxZ/dT53wL2SRs/tbPj0nNfHeK5G+05nEe4nnQUjUp2CpMLxN7M
                mvpb3jFoFnV3hZnhjAM+dHz3IUFY83uZ6tCmTt9hKHmQexMjEveSnKGfRZ8g73M5
                qWp0+rMz6y8vmuVFDSdmW/0v5fiTZoNEb/B3YYJmr2MDT4IQH1WT13JU4M8gn4J+
                F55QMiZOHy7jRiZQMQ0vpIWYct327sK+EwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":39,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3847700,"bpjs":74425,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1R2HaeQ2K6+gi7Hu61LxelpW7hDcFhYah7wN6/96hqMIq6liZtOY
                MjpfNzZpQvcH8RUVOKVVQ6CpCUSalrNlneoQVhVCOOMsY4wsrlCaNhfqDnAUy+Pq
                g3GPKW02/hz38Mb7IZ1pNgD2P1doldJi4LhhnTongArDuKk3yTXX+2N7dHuqYqoU
                2wdjCHQlWwfkZd21pXI91sC8d1NU6gX1G9KK+27e8aQfXErTKO/kNQjablTtN+S2
                TNnoC4Uddsy+o9PH/8ll0ENiRfZCcRF9lIRjuib0LV2omHCspQl0JfGApDLRn8+u
                E9E+DMjS+W3XUSuG8x4b7CxX0QBA6PNVzwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3252900,"tjistri":325290,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":286255,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3552900,"bpjs":68974,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAyBOP6DAAckHg3JDN+Rwjo+Qnlh4zmSWDYU+Xxb8xy3wBWHrV3yow
                naNfXypvNIUSe+MyQ/9wvWDORazubb5QTaW4i6HWRSIzD6Qtfd8bJL9uxk7Gpz99
                thkM9i30h9lCGJod1wJ8I6VuZq72J9pAA464OKy0Iq3LOGOGpfw5INchfL3DR9q6
                SxhngvYP1s34pqToDQzy5XBAsxdzKUOtTDpRmEdDVrThFV2qJg0wdjoLir0mKkt6
                KeUt/+wIM6QZTa2Rvrlbw8WjUxJ7MNVD4YgWPLEBDyU6oeTA4Yru/nZNLJzc1Gug
                looNMhmqI+eGk4i3rLNZ5XrL0jJYiCDKlQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":4671600,"tjistri":467160,"tjanak":186864,"tjupns":0,"tjstruk":0,"tjfungs":960000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":289680,"tjpph":32876,"potpfkbul":0,"potpfk2":0,"potpfk10":426049,"potpph":32876,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":6040500,"bpjs":108807,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAngip29O1zxRnoxxL7lFToAl4KVsmTQZVOWXm+oDkOv7TvEu3Kl0W
                TO/bpp0IjNPV/7NpwBt7FYKTD6NDDGZA2o0w5ykg0hEm9PLM27GcTcqjtVgG93d+
                5DaCm8Gz9O7I/r3LSZTFtls3XpHrpfucHYVNxTQPFsKEkQ9aa67ySdXYJ9IpMK7O
                GatVwwrjCqM6bVDn3R8RFld9pHEsP68jyxLf+sO3lHuUOVNmfiWw8543WtymzRhQ
                Lgsz4nkHsrH9HGNF4HLbpbNdOr73W4z+xPPcAKCun80M8tHlxdhTlTt1NCuL3V9v
                bFqVB8ki/J2/LoGnm3dFpxnwL8JHwDp3lQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":65740,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":83,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":294515,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3715500,"bpjs":73768,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAlG1bOcktswGMm3OMbAQ8vQE5s+SbFKzFfuydQZgDqjv6qaasOShJ
                z/HccJVQRu0nCJkoFcJg2xp49leOJn/OAjk/9nKHrWu5NIq75jz7N+AKTBs/GQUm
                kRVRvxwDrqHoSUknb7kZ4TFFd7v75BAzXhGVY3jHLacZcfkVEHQ+JrTPpZEinQ+q
                hDNqaFJTs2G4QANug6Xv4K0lxjlyzNd9cp+HudCvjpavKYmhfK6QpqgAqAQ+O/nt
                OLFpIEK9zznnIMG2bhC7JYVrcyz8hNG0A+iUl/3BlkCnecFcOauG6eSUJiNTd69M
                zyPOUuzMOtKqg6Rg7/VSHGpqWahLLa9+NwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3426000,"tjistri":342600,"tjanak":68520,"tjupns":0,"tjstruk":0,"tjfungs":1100000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":306969,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":4747300,"bpjs":100163,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1bfVPoaKosUdFhyMzi9fyU/mGHZaO3Sfh8U/XVMy8JZJsc5NRH4C
                uoHodMteSNWpvGQGAk3bmQj+82OpmKRuks30JUy5DrqhyLR1x1p3LuK64JzFAP/7
                7M9xYz6Saxm5/KkS18GibKzp2Ekp2drD9oF74yBakSs6T6UgmvKeDfgIisSh2j6r
                2TtVMmKYXeVOWjrLIigJ8y9lpgrBu3SxZWVi/cvd0G9RjPk+EGnlhJdzLkoZuUrP
                1gLg/zyqySEskJRRSZdWvpJ5anW8GYB85KiJmsqhU5jYQ86sbVPhYESMeCF+WcxX
                4zDwDUxTwvqERp2opDmRfCg6HO0f9xBM5wIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3089300,"tjistri":308930,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":79,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":271858,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3381300,"bpjs":74991,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA0srayhisWCgrPQdxnGcPHf24q99yOxXcoK7BGZFwWBwYuThPzlg1
                NYdRuhg7hMQ9EvDcOHLTniU2g7lPfEBDsRkX/HP1uuzsF2KWYpy9tOXI9OECCHwU
                lu2bD1+5omjOdO61Ugg6Ftse3eyk0QJp0bpxefaA7PBzmYwhkxVYIR7fLFQemtLu
                KIrw/9TidZNEnWuN42/WfFrm8eQ6p0U3B+suug5/jV0VD+Aped/l0nsuKU/H7f2A
                7mRq+tDFSxarBvgDzUNWUJ02bTwdNp2QMMf6y0L+Afs5gcLA6rxjOBm0hO7t5IJA
                FW/ycDxIDOqGhT8M1azluz2f48Eai+bL2QIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":89,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3698900,"bpjs":74425,"bpjs2":148850}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAt+ofitI6wOK4z/WA0csV+wnbDlP9O4LvcY0PnLV4kKDi8PyOeohB
                vAvI8U+4Q4ha/08x0pqCdWFp25JSNWOt8MRG5KgshOVDcWYeqe5GzNfFkMdQVNEn
                pe3hoHxne6BQJbZGfavS63TV4Cja1M/NqgdEAmN3HfKzMJk3C7y8RTcqBfY/MoNL
                pTaLMfdCWciw1JUZn5I1lfNfjekJiSFhhlQGSTEPnpFukrOPZjFHLr4QKrVCzqR+
                JZBVFyqCDJFEjmuTjieSn0zAr5D2+p3prLy/mfZ2jnjo5iKrdoyisOY3Mc40EpVP
                ES7Od6N481lzLH0LFX06rx4MuBJKaG5RFwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3186600,"tjistri":318660,"tjanak":63732,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":10,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":285519,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3613100,"bpjs":72643,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAvSXf5LO86hVpbAG6yMm7RMt1CyQcv7FfqhznyzaF6wbsmq9Nfi6Z
                HgcwHR6PF0xV4aFJWeRDrXjzezyi49SbpJlfRE4xqZp58gG+OhTRfOxWma+1hhbe
                gKescD4Ky53Qir3KykffI92j2yUQxEKBjRMvSBX7DgySag08JiK6StPPKFR+7ash
                +mOYSppwrQHEdNvi6Ox+1ieRuKyR44UEgF+Dq5Txs9g4jxV8ZCsrQ6nLv7dQDlo9
                HZ6e8L7l7Fxmht8DUZHGK1UWeYgUXrpxUXT3LGm3FqdlOrzK58qOJ7Z/VMdtnkNf
                rKBGwIw+ihHsn8RIMlTT0Axe2aVzNR8ZMQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":256420,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":225649,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2854800,"bpjs":65110,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAl7aWV12N0/pjuuKRzNDKFdL2kl4Jmd42fbtLBu25jY4egmtWW4p/
                bm1YC7E6tmU4UV6MViAafY4kz3NsEljY7HZdulkGGQEqXlLoI5EqrhEg7jRSiAQq
                Pj5Cige4Io/FCxVUj1rN0LHvXeIihFPz6NZQVITdPTjGj+lJfSQxr/Jjn6hM+2W9
                To+EAEpiE8QEjOP9WKEm2H0aSSreq90mpgWpMUFSmgFjr/PLkDXBEXpxNTJnRyjH
                Uk3Cse37ZiR7ioKmUiNZ12hGMpYOu6TYuqaAtr8psqAUbu2ONbh7WpMpJnd/w2dO
                fOuIawvof86lF3qQghKzM4atonkgeB6EZwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAw6GzSZd7l7lHIugUGvjmODjzAqAMA2zgHVNhP949UU0RCWeHvTuk
                pjhPljUUFz+JGfou8behUianj3XgVjZkLiQ+QkJMTBf/AFnSwPftykwo6NHW822X
                cy98qHQ1w9p2vh4KGoyim/BPunWWnhuNb+TwdHyVDcEK/LACNIMTnNBwnmpA2/+1
                MRsoWvo1FWXqKc3E9Ck0A9EfMEEMOnqei/uDFYVgVVDblwmpCNaw2n2E0eoY6j0Z
                RejtP0fae2TzXlTgn/c32fF0dmsmOize2hJ5U5DvoP/HrEOJBgynRbItdcUm+cNp
                yAy6amc3IeOExOuhOBGWtG1Kg6J7ruIUSwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":2564200,"tjistri":0,"tjanak":0,"tjupns":180000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":62,"tjberas":72420,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":205136,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":2549000,"bpjs":62546,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAo2gbZIzevqBN7DIXOMg8OdAZ2avV4gjWy+Ru15LECTlT7QXnAVfy
                aTwpLNjaQgJi3H6W30Y1CwQdy5tna3YmuBy7zsEGsSfxI9859gg+pzSzvmmmqCTu
                wCx5Rm0HPATdzsxZ/dT53wL2SRs/tbPj0nNfHeK5G+05nEe4nnQUjUp2CpMLxN7M
                mvpb3jFoFnV3hZnhjAM+dHz3IUFY83uZ6tCmTt9hKHmQexMjEveSnKGfRZ8g73M5
                qWp0+rMz6y8vmuVFDSdmW/0v5fiTZoNEb/B3YYJmr2MDT4IQH1WT13JU4M8gn4J+
                F55QMiZOHy7jRiZQMQ0vpIWYct327sK+EwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":131480,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":39,"tjberas":289680,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":299774,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3847700,"bpjs":74425,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1R2HaeQ2K6+gi7Hu61LxelpW7hDcFhYah7wN6/96hqMIq6liZtOY
                MjpfNzZpQvcH8RUVOKVVQ6CpCUSalrNlneoQVhVCOOMsY4wsrlCaNhfqDnAUy+Pq
                g3GPKW02/hz38Mb7IZ1pNgD2P1doldJi4LhhnTongArDuKk3yTXX+2N7dHuqYqoU
                2wdjCHQlWwfkZd21pXI91sC8d1NU6gX1G9KK+27e8aQfXErTKO/kNQjablTtN+S2
                TNnoC4Uddsy+o9PH/8ll0ENiRfZCcRF9lIRjuib0LV2omHCspQl0JfGApDLRn8+u
                E9E+DMjS+W3XUSuG8x4b7CxX0QBA6PNVzwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3252900,"tjistri":325290,"tjanak":0,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":99,"tjberas":144840,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":286255,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3552900,"bpjs":68974,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAyBOP6DAAckHg3JDN+Rwjo+Qnlh4zmSWDYU+Xxb8xy3wBWHrV3yow
                naNfXypvNIUSe+MyQ/9wvWDORazubb5QTaW4i6HWRSIzD6Qtfd8bJL9uxk7Gpz99
                thkM9i30h9lCGJod1wJ8I6VuZq72J9pAA464OKy0Iq3LOGOGpfw5INchfL3DR9q6
                SxhngvYP1s34pqToDQzy5XBAsxdzKUOtTDpRmEdDVrThFV2qJg0wdjoLir0mKkt6
                KeUt/+wIM6QZTa2Rvrlbw8WjUxJ7MNVD4YgWPLEBDyU6oeTA4Yru/nZNLJzc1Gug
                looNMhmqI+eGk4i3rLNZ5XrL0jJYiCDKlQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":4671600,"tjistri":467160,"tjanak":186864,"tjupns":0,"tjstruk":0,"tjfungs":960000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":289680,"tjpph":32876,"potpfkbul":0,"potpfk2":0,"potpfk10":426049,"potpph":32876,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":6040500,"bpjs":108807,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAngip29O1zxRnoxxL7lFToAl4KVsmTQZVOWXm+oDkOv7TvEu3Kl0W
                TO/bpp0IjNPV/7NpwBt7FYKTD6NDDGZA2o0w5ykg0hEm9PLM27GcTcqjtVgG93d+
                5DaCm8Gz9O7I/r3LSZTFtls3XpHrpfucHYVNxTQPFsKEkQ9aa67ySdXYJ9IpMK7O
                GatVwwrjCqM6bVDn3R8RFld9pHEsP68jyxLf+sO3lHuUOVNmfiWw8543WtymzRhQ
                Lgsz4nkHsrH9HGNF4HLbpbNdOr73W4z+xPPcAKCun80M8tHlxdhTlTt1NCuL3V9v
                bFqVB8ki/J2/LoGnm3dFpxnwL8JHwDp3lQIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3287000,"tjistri":328700,"tjanak":65740,"tjupns":185000,"tjstruk":0,"tjfungs":0,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":83,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":294515,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":3715500,"bpjs":73768,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEAlG1bOcktswGMm3OMbAQ8vQE5s+SbFKzFfuydQZgDqjv6qaasOShJ
                z/HccJVQRu0nCJkoFcJg2xp49leOJn/OAjk/9nKHrWu5NIq75jz7N+AKTBs/GQUm
                kRVRvxwDrqHoSUknb7kZ4TFFd7v75BAzXhGVY3jHLacZcfkVEHQ+JrTPpZEinQ+q
                hDNqaFJTs2G4QANug6Xv4K0lxjlyzNd9cp+HudCvjpavKYmhfK6QpqgAqAQ+O/nt
                OLFpIEK9zznnIMG2bhC7JYVrcyz8hNG0A+iUl/3BlkCnecFcOauG6eSUJiNTd69M
                zyPOUuzMOtKqg6Rg7/VSHGpqWahLLa9+NwIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
            [
                '{"bulan":"05","tahun":"2024","gjpokok":3426000,"tjistri":342600,"tjanak":68520,"tjupns":0,"tjstruk":0,"tjfungs":1100000,"tjdaerah":0,"tjpencil":0,"tjlain":0,"tjkompen":0,"pembul":52,"tjberas":217260,"tjpph":0,"potpfkbul":0,"potpfk2":0,"potpfk10":306969,"potpph":0,"potswrum":0,"potkelbtj":0,"potlain":0,"pottabrum":0,"bersih":4747300,"bpjs":100163,"bpjs2":0}',
                '-----BEGIN RSA PUBLIC KEY-----
                MIIBCgKCAQEA1bfVPoaKosUdFhyMzi9fyU/mGHZaO3Sfh8U/XVMy8JZJsc5NRH4C
                uoHodMteSNWpvGQGAk3bmQj+82OpmKRuks30JUy5DrqhyLR1x1p3LuK64JzFAP/7
                7M9xYz6Saxm5/KkS18GibKzp2Ekp2drD9oF74yBakSs6T6UgmvKeDfgIisSh2j6r
                2TtVMmKYXeVOWjrLIigJ8y9lpgrBu3SxZWVi/cvd0G9RjPk+EGnlhJdzLkoZuUrP
                1gLg/zyqySEskJRRSZdWvpJ5anW8GYB85KiJmsqhU5jYQ86sbVPhYESMeCF+WcxX
                4zDwDUxTwvqERp2opDmRfCg6HO0f9xBM5wIDAQAB
                -----END RSA PUBLIC KEY-----',
            ],
        ];
    }
}
