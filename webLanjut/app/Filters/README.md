# FILTER

## Function

Filter berfungsi sebagai pelindung controller.

- Method **before()** dan **after()** untuk menyaring pada saat sebuah controller diakses.
- Proses filter akan **dialkukan terlebih** dahulu sebelum **(before)** pengaksesan controller maupun sesudah **(after)** pengaksesan controller

Sederhananya:

```bash
route > filter (before) > controller > filter (after)
```
