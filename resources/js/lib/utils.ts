import type { InertiaLinkProps } from "@inertiajs/vue3";

export function urlIsActive(
    urlToCheck: NonNullable<InertiaLinkProps["href"]>,
    currentUrl: string
) {
    return toUrl(urlToCheck) === currentUrl;
}

export function toUrl(href: NonNullable<InertiaLinkProps["href"]>) {
    return typeof href === "string" ? href : href?.url;
}
